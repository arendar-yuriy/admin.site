<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Helpers\Crop;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Sliders;
use App\SliderUnits;
use App\Structure;
use Illuminate\Http\Request;
use App\Http\Requests;

class SlidersController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.sliders');
        $this->model = new Sliders();
        $this->controller = 'sliders';

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
            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'alias'=>[
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

        $oStructure = Structure::published()->orderBy('position')->get();

        $oStructure->linkNodes();

        $aStructure = $oStructure->toArray();

        foreach($aStructure as $key=>$item)
            if($item['parent_id'])
                unset($aStructure[$key]);

        view()->share('aTreeStructure',$aStructure);
        parent::__construct($request);
    }

    public function getAddUnit($id)
    {
        return view($this->controller.'.create_unit');
    }

    /**
     * View edit form of current item
     * @param $id - id of item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditUnit($id)
    {
        $content = SliderUnits::findOrFail($id);

        if($this->isMultiLang){
            $content_lang = $content->translate(FormLang::getCurrentLang());

            if($content_lang === null && $content->id){
                $content->locale = FormLang::getCurrentLang();
                $content->name = '';
                $content->save();
                $content_lang = $content->translate(FormLang::getCurrentLang());
            }
        }else{
            $content_lang = [];
        }


        return view($this->controller.'.edit_unit',['content'=>$content,'translation'=>$content_lang]);
    }

    /**
     * Create new record in database for current parts of admin application
     * @param Request $request
     * @return array|string
     */
    public function postStoreUnit(Requests\SliderUnitsRequest $request,$id)
    {
        $data = $request->all();

        $model = new SliderUnits();

        if($this->isMultiLang)
            $data = prepareDataToAdd($model->translatedAttributes,$data);

        $content = $model->create($data);

        return redirectApp(
            Route('edit_'.$this->controller.'_unit',['id'=>$content->id]),
            '302',trans('app.item was created'),trans('app.Saved'),'success'
        );
    }

    /**
     * Update current item
     * @param Request $request
     * @param $id -  id of current item
     * @return array|string
     */
    public function postUpdateUnit(Requests\SliderUnitsRequest $request,$id)
    {
        $model = new SliderUnits();

        $content = $model->findOrFail($id);
        $data = $request->all();

        if($this->isMultiLang){
            foreach($data as $name=>$item){
                if(!in_array($name,$model->translatedAttributes))
                    $content->{$name} = $item;
                else
                    $content->translate($data['locale'])->{$name} =  $item;
            }
        }else{
            foreach($data as $name=>$item)
                $content->{$name} = $item;
        }

        $content->save();

        return redirectApp(
            Route('edit_'.$this->controller.'_unit',['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }

    public function postCropImage(Request $request,$id)
    {
        $data = SliderUnits::find($id);

        $data_crop = json_decode($request->get('data_crop'),true);

        if(\File::exists(getCropPath($data->image)))
            unlink(getCropPath($data->image));

        if($data_crop =='' && $request->get('data_crop_info')==''){
            $data->is_crop = 0;
            $data->data_crop = '';
            $data->data_crop_info = '';
        }else{
            clearCropThumbs($data->image);

            doCrop($data->image,$data_crop);

            $data->is_crop = 1;
            $data->data_crop = $request->get('data_crop');
            $data->data_crop_info = $request->get('data_crop_info');
        }


        $data->save();

        return redirectApp(route('edit_'.$this->controller,['id'=>$data->slider_id]),'302',trans('app.Image cropped'),trans('app.Saved'),'success');
    }

    public function postGetView(Request $request,$id)
    {
        $data = $request->all();

        $content = SliderUnits::find($id);

        if($content->{$data['filed']} != $data['image'])
        {
            $content->{$data['filed']} = $data['image'];
            $content->data_crop = '';
            $content->data_crop_info = '';
            $content->save();
        }

        return redirectApp(route($this->controller.'_crop_view',['id'=>$content->id]));
    }

    public function getGetView($id)
    {
        $content = SliderUnits::find($id);

        return view('inc.crop',compact('content'));
    }

    public function getActiveUnit(Request $request,$id)
    {
        $data = SliderUnits::find($id);
        $data->published = $request->get('checked');
        $data->save();
        return ['result'=>'ok'];
    }

    public function getDeleteUnit($id)
    {
        if(\Request::ajax()){
            $item = SliderUnits::find($id);
            $name = $item->name;
            if($name === null)
                $name = $item->text;


            if($name === null)
                $name = $item->id;

            Basket::create([
                'admin_user_id'=>\Auth::user()->id,
                'admin_user_name'=>\Auth::user()->name . ' ' . \Auth::user()->lastname,
                'basketable_type'=>get_class($item),
                'basketable_id'=>$item->id,
                'basket_name'=>$name
            ]);
            $item->delete();

            return redirectApp('','302',trans('app.Deleted'));
        }else{
            return redirect('/');
        }

    }

    public function postUnitsPosition(Request $request)
    {

        foreach ($request->all()['data'] as $value)
        {
            $item = SliderUnits::find($value['id']);
            $item->position = $value['position'];
            $item->save();
        }

    }

    /**
     * Create new record in database for current parts of admin application
     * @param Request $request
     * @return array|string
     */
    public function postStore(Requests\SliderRequest $request)
    {
        $data = $request->all();

        $data = prepareDataToAdd($this->model->translatedAttributes,$data);

        $content = $this->model->create($data);

        return redirectApp(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.item was created'),trans('app.Saved'),'success'
        );
    }

    /**
     * Update current item
     * @param Request $request
     * @param $id -  id of current item
     * @return array|string
     */
    public function postUpdate(Requests\SliderRequest $request,$id)
    {
        $content = $this->model->find($id);
        $data = $request->all();

        foreach($data as $name=>$item){
            if(!in_array($name,$this->model->translatedAttributes))
                $content->{$name} = $item;
            else
                $content->translate($data['locale'])->{$name} =  $item;
        }

        $content->save();

        return redirectApp(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }
}
