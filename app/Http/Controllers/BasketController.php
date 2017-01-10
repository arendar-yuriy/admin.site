<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Helpers\Main;
use App\Helpers\Table;
use Illuminate\Http\Request;

class BasketController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.Basket');
        $this->controller = 'basket';
        $this->model = new Basket();

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
        $table->isMultiLang  = true;
        $table->controller = $this->controller;
        $table->actionGroupDeselect = false;
        $table->actionGroupActive = false;
        $table->actionGroupRecovery = true;
        $table->columns  = [
            'basket_name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'basketable_type'=>[
                'order'=>true,
                'type'=>'basketable_type',
            ],
            'created_at'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'recovery'=>[
                'order'=>false,
                'type'=>'recovery',
                'width'=> 10
            ],
            'delete_without_recovery'=>[
                'order'=>false,
                'type'=>'delete_without_recovery',
                'width'=> 10
            ],
        ];

        $data['header'] = $table->columns;

        if(\Auth::user()->hasRole(['programmer','admin']))
            $data['data'] = $this->model->all()->toArray();
        else
            $data['data'] = $this->model->where('admin_user_id',\Auth::user()->id)->get()->toArray();

        view()->share('count',count($data['data']));

        $table_view =  $table->getView($data);

        return view($this->controller.'.index',compact('table_view'));
    }

    /**
     * Delete current item
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postDeleteAll()
    {
        if(\Request::ajax()){
            $items = $this->model->all();

            foreach($items as $item){
                $basket = $item->basketable()->withTrashed()->first();

                if($basket !== null) $basket->forceDelete();

                $item->delete();
            }

            return Main::redirect('','302',trans('basket.Deleted all items'));
        }else{
            return redirect('/');
        }

    }

    /**
     * Group force delete
     * @param Request $request
     * @return array
     */

    public function postGroupDelete(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id){
                $item = $this->model->find($id);
                $basket = $item->basketable()->withTrashed()->first();

                if($basket !== null) $basket->forceDelete();

                $item->delete();
            }

        }

        return Main::redirect('','302',trans('basket.Deleted'));


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

            $basket = $item->basketable()->withTrashed()->first();

            if($basket !== null) $basket->forceDelete();

            $item->delete();

            return Main::redirect('','302',trans('app.Deleted'));
        }else{
            return redirect('/');
        }

    }

    /**
     * Recovery current item from basket
     * @param $id - id of item
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getRecovery($id)
    {
        if(\Request::ajax()){
            $item = $this->model->find($id);

            $recovery = $item->basketable()->withTrashed()->first();

            if($recovery !== null) $recovery->restore();

            $item->delete();
            return Main::redirect('','302',trans('basket.Restored'));
        }else{
            return redirect('/');
        }

    }


    /**
     * Recovery current item from basket
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRecoveryAll()
    {
        if(\Request::ajax()){

            $items = $this->model->all();

            foreach($items as $item){
                $recovery = $item->basketable()->withTrashed()->first();

                if($recovery !== null) $recovery->restore();

                $item->delete();
            }

            return Main::redirect('','302',trans('basket.All items was restored'));
        }else{
            return redirect('/');
        }

    }

    public function postGroupRestore(Request $request)
    {
        $data = $request->all();

        if(!empty($data['data'])){
            foreach ($data['data'] as $id) {
                $item = $this->model->find($id);

                $recovery = $item->basketable()->withTrashed()->first();

                $recovery->restore();

                $item->delete();
            }
        }

        return Main::redirect('', '302', trans('basket.Items was restored'));
    }
}
