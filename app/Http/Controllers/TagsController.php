<?php

namespace App\Http\Controllers;

use App\Content;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\Table;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.tags');
        $this->model = new Tag();
        $this->controller = 'tags';
        $this->isMultiLang = false;
        $this->columns = [
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
            'alias'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'text'=>[
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

        parent::__construct($request);
    }

    /**
     * Main action for current part of admin application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $table = new Table();
        $table->dataModel = $this->model;
        $table->isMultiLang  = $this->isMultiLang;

        $table->columns  = $this->columns;

        $data['data'] = $this->model->orderBy('created_at', 'desc')->get()->toArray();

        $table->controller = $this->controller;
        $data['header'] = $table->columns;
        $table =  $table->getView($data);

        return view($this->controller.'.index',['table'=>$table]);
    }

    public function getEdit($id)
    {
        $tag = $this->model->find($id);
        $table = new Table();
        $table->dataModel = new Content();
        $table->isMultiLang  = true;
        $table->controller = 'content';
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

            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'created_at'=>[
                'order'=>true,
                'type'=>'default',
            ],
        ];

        $tempo_locale = \App::getLocale();
        \App::setLocale(FormLang::getCurrentLang());



        $data['data'] = $tag->contents()->orderBy('created_at', 'desc')->get()->toArray();


        \App::setLocale($tempo_locale);

        $data['header'] = $table->columns;

      //  dd($data);
        $table_view =  $table->getView($data);


        view()->share('table_content',$table_view->render());

        return view($this->controller.'.edit',['content'=>$tag]);
    }


    public function postStore(Request $request)
    {
        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        $name = $request->get('text');
        $alias = \URLify::filter($name);

        $content = $this->model->create(['text'=>$name,'alias'=>$alias]);
        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.item was created'),trans('app.Saved'),'success'
        );
    }

    public function postNew(Request $request)
    {
        $name = $request->get('name');
        $alias = \URLify::filter($name);

        $tag = $this->model->where('text',$name)->orWhere('alias',$alias)->first();

        if($tag === null){
            $tag = $this->model->create(['text'=>$name,'alias'=>$alias]);
        }else{
           return [false];
        }

        return ['id'=>$tag->id,'text'=>$name];
    }

    public function postSearch(Request $request)
    {
        $data = $this->model->where('text', 'like', '%'.$request->get('term').'%')->get();
        $result = [];
        foreach($data as $val){
            $result[] = ['id'=>$val->id,'text'=>$val->text];
        }

        return $result;
    }

    public function postKeywords(Request $request)
    {
        $data = $this->model->where('text', 'like', '%'.$request->get('term').'%')->get();
        $result = [];
        foreach($data as $val){
            $result[] = ['id'=>$val->text,'text'=>$val->text];
        }

        return $result;
    }



}
