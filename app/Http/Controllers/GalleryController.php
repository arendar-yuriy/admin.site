<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Gallery;
use App\GalleryUnit;
use App\Helpers\Cpu;
use App\Helpers\Crop;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\Table;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;

class GalleryController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->title = trans('app.gallery');

        $this->controller = 'gallery';

        $this->model = new Gallery();


        $list_folder = $this->model->pluck('id')->toArray();

        foreach($list_folder as $k=>$v){
            if(!$this->model->find($v)->units->isEmpty())
                unset($list_folder[$k]);

        }

        $tags = Tag::where('published',1)->get();

        view()->share('tags',$tags);

        view()->share('list_folder',$list_folder);

        parent::__construct($request);
    }

    public function index()
    {
        $id = \Route::current()->parameter('id');

        $listFolders = $this->model->where('parent_id',$id)->get();

       return view($this->controller.'.index',compact('listFolders'));
    }

    public function getEdit($id)
    {
        $tempo_locale = \App::getLocale();
        \App::setLocale(FormLang::getCurrentLang());

        $oFolder = $this->model->find($id);

        if($oFolder->units->count()>0){
            $images = $oFolder->units()->orderBy('position','asc')->get()->toArray();
            view()->share('images',$images);

            $table = new Table();
            $table->dataModel = new GalleryUnit();
            $table->isMultiLang  = true;
            $table->controller = $this->controller;
            $table->by_position = true;
            $table->imageTable = true;
            $table->columns  = [
                'id'=>[
                    'order'=>true,
                    'type'=>'default',
                    'width'=> 10
                ],
                'image'=>[
                    'order'=>false,
                    'type'=>'image',
                ],
                'published_image'=>[
                    'order'=>true,
                    'type'=>'bool_image',
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
                'image_actions'=>[
                    'order'=>false,
                    'type'=>'image_actions',
                    'width'=>10
                ],
            ];

            $data['header'] = $table->columns;
            $data['data'] = $images;
            $table_view =  $table->getView($data);



            view()->share('table_image',$table_view->render());

        }else{
            $table_folders = new Table();

            $table_folders->isMultiLang = true;

            $table_folders->controller = $this->controller;

            $table_folders->by_position = $oFolder->by_position;

            $table_folders->columns = [
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
                'image'=>[
                    'order'=>false,
                    'type'=>'image',
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

            if ($oFolder->by_position)
                $folders = $this->model->where('parent_id',$id)->orderBy('position','asc')->get()->toArray();
            else
                $folders = $this->model->where('parent_id',$id)->get()->toArray();

            $data['header'] = $table_folders->columns;
            $data['data'] = $folders;
            $table_folders =  $table_folders->getView($data);

            view()->share('table_folders',$table_folders->render());
        }



        \App::setLocale($tempo_locale);

        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }

    public function image(Request $request,$id)
    {

        $data = $request->all();

        foreach($data['images'] as $key=>$image){
            $position = GalleryUnit::where('gallery_id',$id)->max('position');
            GalleryUnit::create([
                'image'=>$this->controller.'/'.$id.'/'.$key,
                'name'=>$image['name'],
                'gallery_id'=>$id,
                'description'=>$image['description'],
                'position'=>++$position
            ]);
        }

        return redirectApp('','302', trans('app.data saved'),trans('app.Saved'),'success');
    }

    public function postStore(Requests\GalleryRequest $request)
    {

        $parent_id = \Route::current()->parameter('id');
        $data = $request->all();

        if($parent_id !== null && !$data['parent_id']){
            $data['parent_id'] = $parent_id;
        }

        $alias = generateAlias($data['name'],$this->model);

        $data['alias_ru'] = $alias['ru'];
        $data['alias_en'] =  $alias['en'];

        if($this->isMultiLang)
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
    public function postUpdate(Requests\GalleryRequest $request,$id)
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

    public function getEditImage($id)
    {
        $content = GalleryUnit::find($id);
        view()->share('tagsList',$content->tags()->pluck('tag_id')->toArray());
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


        return view($this->controller.'.edit_image',['content'=>$content,'translation'=>$content_lang]);
    }

    public function postImageUpdate(Request $request,$id)
    {
        $content = GalleryUnit::find($id);
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
        unset($data['tags']);

        if($this->isMultiLang){
            foreach($data as $name=>$item){
                if(!in_array($name,$content->translatedAttributes))
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
            Route('edit_image_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }

    public function getImageActive(Request $request,$id)
    {
        $data = GalleryUnit::find($id);
        $data->published = $request->get('checked');
        $data->save();
        return ['result'=>'ok'];
    }

    public function getImageDelete($id)
    {
        if(\Request::ajax()){
            $item = GalleryUnit::find($id);
            $item->delete();
            return redirectApp('','302',trans('app.Deleted'));
        }else{
            return redirect('/');
        }
    }

    public function getCropUnitImage($id)
    {
        $content = GalleryUnit::find($id);
        return view('gallery.crop_image',compact('content'));
    }

    public function postCropUnit(Request $request,$id)
    {
        $data = GalleryUnit::find($id);

        $data_crop = json_decode($request->get('data_crop'),true);

        if(\File::exists(getCropPath($data->image)))
            unlink(getCropPath($data->image));

        if($request->get('data_crop')=='' && $request->get('data_crop_info')==''){
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

        return redirectApp('','302',trans('app.data saved'),trans('app.Saved'),'success');
    }

    /**
     * Group delete
     * @param Request $request
     * @return array
     */
    public function postGroupDeleteUnits(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = GalleryUnit::find($id);
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
            }

        }

        return redirectApp('','302',trans('app.Deleted'));

    }

    /**
     * Set status publish to selected items
     * @param Request $request
     * @return array
     */
    public function postGroupActiveUnits(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = GalleryUnit::find($id);

                $item->published = true;

                $item->save();
            }

        }

        return redirectApp('','302',trans('app.Set active'));
    }

    /**
     * Set publish status to false
     * @param Request $request
     * @return array
     */
    public function postGroupDeselectActiveUnits(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = GalleryUnit::find($id);

                $item->published = false;

                $item->save();
            }

        }

        return redirectApp('','302',trans('app.Remove active'));

    }


    public function postPosition(Request $request,$id)
    {
        $oFolder = $this->model->find($id);

        if($oFolder->units->count() > 0){
            $data = $request->get('data');

            $data = json_decode($data,true);

            foreach ($data as $key=>$val){

                $item = GalleryUnit::find($val['id']);

                $item->position = $val['position'];

                $item->save();
            }
        }else{
            $data = $request->get('data');

            $data = json_decode($data,true);

            foreach ($data as $key=>$val){

                $item = $this->model->find($val['id']);

                $item->position = $val['position'];

                $item->save();
            }
        }



    }
}