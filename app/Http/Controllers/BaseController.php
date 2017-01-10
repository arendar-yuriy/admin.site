<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Helpers\Crop;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\Table;
use App\Helpers\TreeBuilder;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    /**
     * name of current layout template
     * @var string
     */
    protected $layout = 'default';

    /**
     * Title of current part
     * @var string
     */
    protected $title = '';


    /**
     * default model of controller
     * @var
     */
    public $model;


    /**
     * current controller
     * @var string
     */
    public $controller  = '';

    /**
     * Columns settings for display in table
     * @var array
     */
    public $columns = [];

    /**
     * If has translation table
     * @var bool
     */
    public $isMultiLang = true;

    /**
     * if has active field in table
     * @var bool
     */
    public $actionGroupDeselect = true;

    /**
     * if has active field in table
     * @var bool
     */
    public $actionGroupActive = true;

    public function __construct(Request $request)
    {
        view()->share('title',$this->title);
        view()->share('controller',$this->controller);
    }


    /**
     * Change published status of current item
     * @param Request $request
     * @param $id - id of current item
     * @return array - json response
     */
    public function getActive(Request $request,$id)
    {
        $data = $this->model->find($id);
        $data->published = $request->get('checked');
        $data->save();
        return ['result'=>'ok'];
    }

    /**
     * Change status of current item
     * @param Request $request
     * @param $id - id of current item
     * @return array - json response
     */
    public function getStatus(Request $request,$id)
    {
        $status = $request->get('status');
        $item = $this->model->find($id);
        $item->status =  $status;
        $item->save();
        return ['result'=>'ok'];
    }


    /**
     * Delete current item
     * @param $id - id of item
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getDelete($id)
    {
        if(\Request::ajax()){
            $item = $this->model->find($id);
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

    /**
     * Group delete
     * @param Request $request
     * @return array
     */
    public function postGroupDelete(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = $this->model->find($id);
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
    public function postGroupActive(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = $this->model->find($id);

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
    public function postGroupDeselectActive(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = $this->model->find($id);

                $item->published = false;

                $item->save();
            }

        }

        return redirectApp('','302',trans('app.Remove active'));

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
        $table->actionGroupActive = $this->actionGroupActive;
        $table->actionGroupDeselect = $this->actionGroupDeselect;

        $table->columns  = $this->columns;

        $tempo_locale = \App::getLocale();
        \App::setLocale(FormLang::getCurrentLang());
        $data['data'] = $this->model->orderBy('created_at', 'desc')->get()->toArray();
        \App::setLocale($tempo_locale);

        $data['header'] = $table->columns;
        $table =  $table->getView($data);

        return view($this->controller.'.index',['table'=>$table]);
    }

    /**
     * Action for view add form of current parts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return view($this->controller.'.create');
    }

    /**
     * View edit form of current item
     * @param $id - id of item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $content = $this->model->find($id);

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


        return view($this->controller.'.edit',['content'=>$content,'translation'=>$content_lang]);
    }


    /**
     * rebuild tree structure with nested tree
     * @param Request $request
     * @return mixed
     */
    public function postRebuild(Request $request){

        $build = new TreeBuilder();

        $data =json_decode($request->input('data'),true);

        $newRelations = $build->generateRelations($data);
        foreach($newRelations as $item){
            $struct = $this->model->find($item['id']);
            $struct->parent_id = $item['parent_id'];
            $struct->position = $item['position'];
            $struct->save();
        }

        $this->model->fixTree();

        return $newRelations;
    }

    public function postCropImage(Request $request,$id)
    {
        $data = $this->model->find($id);

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

        return redirectApp(route('edit_'.$this->controller,['id'=>$data->id]),'302',trans('app.Image cropped'),trans('app.Saved'),'success');
    }

    public function postGetView(Request $request,$id)
    {
        $data = $request->all();

        $content = $this->model->find($id);

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
        $content = $this->model->find($id);

        return view('inc.crop',compact('content'));
    }

    public function postMeta(Request $request,$id)
    {
        $data = $request->all();

        $item = $this->model->find($id);

        $item->metatags = json_encode($data);

        $item->save();

        return redirectApp('','302',trans('app.data saved'),trans('app.Saved'),'success');
    }

    public function postPosition(Request $request,$id)
    {

        $data = $request->get('data');

        $data = json_decode($data,true);

        foreach ($data as $key=>$val){

            $item = $this->model->find($val['id']);

            $item->position = $val['position'];

            $item->save();
        }

    }

}
