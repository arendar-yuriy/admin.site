<?php

namespace App\Http\Controllers;

use App\Content;
use App\Helpers\Cpu;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\Table;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlocksController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.blocks');
        $this->model = new Content();
        $this->controller = 'blocks';

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

        $table->controller = $this->controller;
        $table->columns  = $this->columns;

        $tempo_locale = \App::getLocale();
        \App::setLocale(FormLang::getCurrentLang());
        $data['data'] = $this->model->where('type','=','blocks')->orderBy('created_at', 'desc')->get()->toArray();
        \App::setLocale($tempo_locale);

        $data['header'] = $table->columns;
        $table =  $table->getView($data);

        return view($this->controller.'.index',['table'=>$table]);
    }

    public function postStore(Request $request)
    {
        $this->validation->mergeRules('alias','unique:contents');
        $this->validation->mergeRules('alias','required:contents');
        $data = $request->all();

        if(isset($this->model->validation_rules['alias_customer'])){
            $this->validation->mergeRules('alias','unique:contents');
            $this->validation->mergeRules('alias_customer','unique:contents');
            if(isset($data['alias_priority']) && $data['alias_priority']==1){
                $this->validation->mergeRules('alias_customer','required:contents');
                $this->validation->mergeRules('alias_customer','unique:contents');
            }

            $alias = Cpu::generate($data['name'],$this->model);

            $data['alias_ru'] = $alias['ru'];
            $data['alias_en'] =  $alias['en'];
        }


        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        if($this->isMultiLang)
            $data = Main::prepareDataToAdd($this->model->translatedAttributes,$data);

        $content = $this->model->create($data);

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.item was created'),trans('app.Saved'),'success'
        );
    }

    public function postUpdate(Request $request, $id)
    {
        $this->validation->mergeRules('alias','required:contents');
        $content = $this->model->find($id);
        $data = $request->all();

        if($this->validation->fails())
            return $this->validation->errors()->toJson();
        if($this->isMultiLang){
            foreach($data as $name=>$item){
                if(!in_array($name,$this->model->translatedAttributes))
                    $content->{$name} = $item;
                else
                    $content->translate($data['locale'])->{$name} =  $item;
            }
        }else{
            foreach($data as $name=>$item)
                $content->{$name} = $item;
        }

        $content->save();

        return Main::redirect(
            Route('edit_blocks',['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }
}
