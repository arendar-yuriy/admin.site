<?php

namespace App\Http\Controllers;

use App\Content;
use App\ContentStructure;
use App\Gallery;
use App\Helpers\Cpu;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\Table;
use App\Helpers\TreeBuilder;
use App\Structure;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Route;
use Illuminate\Support;

class ContentController extends BaseController
{
    public $structure;

    public function __construct(Request $request)
    {
        $this->title = trans('app.content');
        $this->model = new Content();
        $this->controller = 'content';
        if(\Route::current()->parameter('structure_id'))
        {
            $this->structure = Structure::find(\Route::current()->parameter('structure_id'));
        }elseif(\Route::current()->parameter('id')){
            if(!$request->ajax())
                $this->structure = $this->model->find(\Route::current()->parameter('id'))->structures()->first();
            else
                $this->structure = null;
        }else{
            $this->structure = null;
        }

        if($this->structure){
            view()->share('structure_id',$this->structure->id);
            view()->share('oStructure',$this->structure);
        }else{
            view()->share('structure_id',null);
            view()->share('oStructure',null);
        }

        $tags = Tag::where('published',1)->get();

        view()->share('tags',$tags);

        parent::__construct($request);
    }

    public function index()
    {
        if($this->structure && $this->structure->controller == 'pages'){
            $oContent = $this->structure->contents()->first();
            if($oContent){
                return redirect(route('edit_content',['id'=>$oContent->id]));
            }else{
                return redirect(route('content_add',['structure_id'=>$this->structure->id]));
            }
        }

        if($this->structure && $this->structure->controller == 'gallery'){
            $oGallery = $this->structure->gallery()->first();
            if(!$oGallery)
                $oGallery = Gallery::create(['name'=>$this->structure->name,'structure_id'=>$this->structure->id]);


            return redirect(route('edit_gallery',['id'=>$oGallery->id]));

        }

        $table = new Table();
        $table->dataModel = $this->model;
        $table->isMultiLang  = true;
        $table->controller = $this->controller;
        $table->columns  = [
            'edit'=>[
                'order'=>false,
                'type'=>'edit',
                'width' => 10,
            ],
            'id'=>[
                'order'=>true,
                'type'=>'default',
                'width'=> 10
            ],
            'published'=>[
                'order'=>true,
                'type'=>'bool',
                'width'=> 10
            ],
            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'created_at'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'delete'=>[
                'order'=>false,
                'type'=>'delete',
                'width'=> 10
            ],
        ];

        $tempo_locale = \App::getLocale();
        \App::setLocale(FormLang::getCurrentLang());



        if($this->structure){
            if($this->structure->controller == 'list' && $this->structure->by_position){
                $table->by_position = $this->structure->by_position;
                $data['data'] = $this->structure->contents()->where('type','<>','blocks')->with('releted')->orderBy('position','asc')->get()->toArray();
            }
            else{
                $data['data'] = $this->structure->contents()->where('type','<>','blocks')->orderBy('created_at','desc')->get()->toArray();
            }

        }
        else{
            $data['data'] =$this->model->where('type','<>','blocks')->orderBy('created_at','desc')->get()->toArray();
        }


       // dd($data);
        \App::setLocale($tempo_locale);

        $data['header'] = $table->columns;
        $table_view =  $table->getView($data);
        
        return view('content.index',['type'=>'content','table'=>$table_view]);
    }

    /**
     * Action for view add form of current parts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        view()->share('tagsList',[]);
        return view($this->controller.'.create');
    }


    public function getEdit($id)
    {
        $content = $this->model->find($id);

        view()->share('tagsList',$content->tags()->pluck('tag_id')->toArray());
        $content_lang = $content->translate(FormLang::getCurrentLang());
        if($content_lang === null && $content->id){
            $content->locale = FormLang::getCurrentLang();
            $content->name = '';
            $content->save();
            $content_lang = $content->translate(FormLang::getCurrentLang());
        }

        return view('content.edit',['content'=>$content,'translation'=>$content_lang,'type'=>$content->type]);
    }

    public function postStore(Request $request)
    {
        $data = $request->all();
        $category_id = \Route::current()->parameter('structure_id');
        $this->structure = Structure::find($category_id);
        if(isset($this->model->validation_rules['alias_customer']) && $this->structure->controller == 'list'){
            $this->validation->mergeRules('alias','unique:'.str_plural($this->controller));
            $this->validation->mergeRules('alias_customer','unique:'.str_plural($this->controller));
            if($data['alias_priority']==1){
                $this->validation->mergeRules('alias_customer','required:'.str_plural($this->controller));
                $this->validation->mergeRules('alias_customer','unique:'.str_plural($this->controller));
            }

            $alias = Cpu::generate($data['name'],$this->model);

            $data['alias_ru'] = $alias['ru'];
            $data['alias_en'] =  $alias['en'];
        }


        if($this->validation->fails())
            return $this->validation->errors()->toJson();


        $data = Main::prepareDataToAdd($this->model->translatedAttributes,$data);

        $content = $this->model->create($data);

        $content->structures()->attach($category_id);

        if(!empty($data['tags'])){
            $tags = $data['tags'];
            unset($data['tags']);

            foreach($tags as $id){
                $content->tags()->attach($id);
            }

        }

        $max = ContentStructure::where('structure_id','=',$category_id)->max('position');

        $cs = ContentStructure::where('content_id','=',$content->id)->where('structure_id','=',$category_id)->first();
        $cs->position = $max + 1;

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.content was created'),trans('app.Created'),'success'
        );
    }


    public function postUpdate(Request $request,$id)
    {


        $content = $this->model->find($id);
        $data = $request->all();

        if(!empty($data['tags'])){
            $tags = $data['tags'];
            unset($data['tags']);
            $content->tags()->detach();
            foreach($tags as $id){
                $content->tags()->attach($id);
            }

        }else{
            $content->tags()->detach();
        }

        if(isset($data['alias_priority']) && $data['alias_priority']==1)
            $this->validation->mergeRules('alias_customer','required:contents');


        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        foreach($data as $name=>$item){
            if(!in_array($name,$this->model->translatedAttributes))
                $content->{$name} = $item;
            else
                $content->translate($data['locale'])->{$name} =  $item;
        }


        $content->save();

        return Main::redirect(
            Route('edit_content',['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }

    public function postPosition(Request $request,$id)
    {
        $data = $request->get('data');

        $data = json_decode($data,true);

        foreach ($data as $key=>$val){
            $mas = [$val['position'],$val['id'],$id];

            \DB::query('update content_structure set position = ? where content_id = ? and structure_id = ? ',$mas);

            $item = ContentStructure::where('content_id',$val['id'])->where('structure_id',$id)->first();
            $item ->position = $val['position'];

            $item->save();
        }
    }
}
