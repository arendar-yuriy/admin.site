<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Helpers\Main;
use Illuminate\Http\Request;

use App\Http\Requests;

class ConstantsController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.constants');
        $this->model = new Constants();
        $this->controller = 'constants';

        parent::__construct($request);
    }

    public function index()
    {
        $current_group = \Route::current()->parameter('group');

        if($current_group === null){
            $groups = $this->model->distinct()->select('group')->get();

            foreach($groups as $key=>$group)
                $groups[$key]->items = $this->model->where('group',$group->group)->get();
        }else{
            $groups = $this->model->distinct()->select('group')->where('group',$current_group)->get();

            foreach($groups as $key=>$group)
                $groups[$key]->items = $this->model->where('group',$group->group)->get();
        }


        return view($this->controller.'.index',compact('groups')) ;
    }

    public function getAdd()
    {
        $type = \Route::current()->parameter('type');
        return view($this->controller.'.create',['type'=>$type]);
    }

    public function postStore(Requests\ConstantsRequest $request)
    {
        $type = $request->get('type');
        $group = $request->get('group');

        $data = $request->all();

        switch($type){
            case 'string':

                break;
            case 'enumeration':

                if(!empty($request->get('values'))){
                    $data['values'] = implode(',',$request->get('values'));
                    $data['value'] = $request->get('values')[0];
                }

                break;
            case 'multiplicity':

                if(!empty($request->get('values'))){
                    $data['values'] = implode(',',$request->get('values'));
                    $data['value'] = implode(',',$request->get('values'));
                }

                break;
            case 'array':
                if(!empty($request->get('values'))){
                    $data['values'] = implode(',',$request->get('values'));
                    $data['value'] = json_encode($request->get('data'));
                }
                break;
            case 'file':

                break;
        }

        $this->model->create($data);

        return redirectApp(
            Route($this->controller,['group'=>$group]),
            '302',trans('app.item was created'),trans('app.Saved'),'success'
        );
    }

    public function postUpdate(Request $request, $id)
    {

        $value = $request->get('value');
        $data = $this->model->find($id);
        $type = $data->type;

        switch($type){
            case 'multiplicity':

                $value = implode(',',$value);

                break;
            case 'array':

                $val = json_decode($data->value,true);

                $val[$request->get('name')] = $value;

                $value = json_encode($val);

                break;

        }

        $data->value = $value;

        $data->save();
    }

    public function postChangeGroup(Request $request,$id)
    {
        $data = $this->model->find($id);
        $data->group = $request->get('group');
        $data->save();
        return redirectApp( Route($this->controller,['group'=>$request->get('group')]));
    }
}
