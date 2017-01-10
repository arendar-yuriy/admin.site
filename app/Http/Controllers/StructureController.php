<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Structure;
use App\Helpers\Cpu;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\TreeBuilder;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StructureRequest;

class StructureController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.structure');
        $this->model = new Structure();
        $this->controller = 'structure';

        $tags = Tag::where('published',1)->get();

        view()->share('tags',$tags);
        parent::__construct($request);
    }

    public function index()
    {
        $build = new TreeBuilder();
        $lang = \LaravelLocalization::getCurrentLocale();
        \LaravelLocalization::setLocale(FormLang::getCurrentLang());
        $structures = $this->model->get()->sortBy('position');

        foreach ($structures as $key=>$struct) {
            if($struct->name == '')
                $struct->name = '<i class="icon-pen"></i>';
            $structures[$key]->link = route('edit_structure',['id'=>$struct->id]);
        }

        $structures->linkNodes();

        $str =  $structures->toArray();

        $editTemplate = false;
        $mainTemplate = view('structure.templates.main')->render();

        if(\Auth::user()->can([$this->controller.'-add-delete'])){
            $editTemplate = true;
        }

        if(\Auth::user()->can([$this->controller.'-add-delete',$this->controller.'-edit'])){
            $mainSingle = view('structure.templates.single_allow',['edit'=>$editTemplate])->render();
            $mainMulti = view('structure.templates.multi_allow',['edit'=>$editTemplate])->render();
        }else{
            $mainSingle = view('structure.templates.single_allow',['edit'=>$editTemplate])->render();
            $mainMulti = view('structure.templates.multi_allow',['edit'=>$editTemplate])->render();
        }


        $view = $build->view(
            $str,
            $mainTemplate,
            $mainSingle,
            $mainMulti
        );
        \LaravelLocalization::setLocale($lang);

        return view('structure.index',compact('view'));
    }


    public function getAdd()
    {
        $oStructure = Structure::published()->orderBy('position')->get();

        $oStructure->linkNodes();

        $aStructure = $oStructure->toArray();

        foreach($aStructure as $key=>$item)
            if($item['parent_id'])
                unset($aStructure[$key]);

        view()->share('aTreeStructure',$aStructure);

        return view('structure.create');
    }

    public function getEdit($id)
    {
        $content = $this->model->find($id);

        $content_lang = $content->translate(FormLang::getCurrentLang());
        if($content_lang === null && $content->id){
            $content->locale = FormLang::getCurrentLang();
            $content->name = '';
            $content->save();
            $content_lang = $content->translate(FormLang::getCurrentLang());
        }

        $oStructure = Structure::published()->orderBy('position')->get();

        $oStructure->linkNodes();

        $aStructure = $oStructure->toArray();

        foreach($aStructure as $key=>$item)
            if($item['parent_id'])
                unset($aStructure[$key]);

        view()->share('aTreeStructure',$aStructure);

        return view('structure.edit',['content'=>$content,'translation'=>$content_lang]);
    }

    public function postStore(StructureRequest $request)
    {
        $data = $request->all();
        $alias = Cpu::generate($data['name'],$this->model);
        if(!empty($data['menu_level']))
            $data['menu_level'] = implode(',',$data['menu_level']);
        else
            $data['menu_level'] = '';
        $data['alias_ru'] = $alias['ru'];
        $data['alias_en'] =  $alias['en'];

        $data_main = [];

        $data = Main::prepareDataToAdd($this->model->translatedAttributes,$data);

        foreach($data as $key=>$value){
            if(!in_array($key,array_keys(\LaravelLocalization::getSupportedLocales()))){
                $data_main[$key]=$value;
            }
        }

        $content = $this->model->create($data_main);

        foreach(\LaravelLocalization::getSupportedLocales() as $key=>$locale){
            foreach($data[$key] as $k=>$item){
                if(!in_array($k,$this->model->translatedAttributes))
                    $content->{$name} = $item;
                else
                    $content->translateOrNew($key)->{$k} =  $item;
            }
        }

        $content->save();

        if($content->controller == 'gallery'){
            $oGallery = $content->gallery()->first();
            if(!$oGallery)
                Gallery::create(['name'=>$content->name,'structure_id'=>$content->id,'image'=>$content->image]);
        }

        return Main::redirect(
            Route('edit_structure',['id'=>$content->id]),
            '302',trans('app.structure was created'),trans('app.Saved'),'success'
        );
    }

    public function postUpdate(StructureRequest $request,$id)
    {
        $content = $this->model->find($id);
        $data = $request->all();
        if(!empty($data['menu_level']))
            $data['menu_level'] = implode(',',$data['menu_level']);
        else
            $data['menu_level'] = '';

        foreach($data as $name=>$item){
            if(!in_array($name,$this->model->translatedAttributes))
                $content->{$name} = $item;
            else
                $content->translate($data['locale'])->{$name} =  $item;
        }

        $content->save();

        if($content->controller == 'gallery'){
            $oGallery = $content->gallery()->first();
            if(!$oGallery)
                Gallery::create(['name'=>$content->name,'structure_id'=>$content->id,'image'=>$content->image]);
        }

        return Main::redirect(
            Route('edit_structure',['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }
}
