<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Revision;
use App\SiteUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;

class SiteUsersController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.Site Users');
        $this->model = new SiteUser();
        $this->controller = 'siteusers';
        $this->actionGroupDeselect = false;
        $this->actionGroupActive = false;

        $this->isMultiLang = false;
        $this->columns = [
            'edit'=>[
                'order'=>false,
                'type'=>'edit',
            ],
            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'email'=>[
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
            ],
        ];

        parent::__construct($request);
    }

    public function index()
    {
        $listUsers = $this->model->get();

        return view($this->controller.'.index',compact('listUsers'));
    }

    public function getEditPassword($id)
    {
        $content = $this->model->find($id);
        return view($this->controller.'.edit_password',compact('content'));
    }

    /**
     * Action for view add form of current parts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $roles = Role::all();
        return view($this->controller.'.create',compact('roles'));
    }

    public function postNewPassword(Request $request,$id)
    {
        $content = $this->model->find($id);

        if(trim($request->get('password')) == ''){
            return ['password'=>trans('app.The password field is required')];
        }

        if($request->get('password') != $request->get('password_confirmation')){
            return ['password_confirmation'=>trans('app.The password confirmation does not match')];
        }

        $content->password = Hash::make($request->get('password'));

        $content->save();

        return Main::redirect('','302',trans('app.password changed'),trans('app.Saved'),'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {

        $this->validation->mergeRules('email','unique:users');

        $this->validation->mergeRules('password','required');


        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        if($request->get('password') != $request->get('password_confirmation')){
            return ['password_confirmation'=>trans('app.The password confirmation does not match')];
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = SiteUser::create($input);

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$user->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }

    /**
     * View edit form of current item
     * @param $id - id of item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $content = $this->model->findOrFail($id);

        if(\Auth::user()->can([$this->controller.'-add-delete',$this->controller.'-edit']))
            return view($this->controller.'.edit',compact('content'));

        return view($this->controller.'.view',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        $input = $request->all();

        $user = SiteUser::find($id);
        $user->update($input);


        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$user->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }


    public function getLogsUser($id)
    {
        $user = $this->model->findOrFail($id);
        if(\Config::get('database.default')=='pgsql'){
            $logs = DB::select("select DISTINCT created_at::date from user_log WHERE user_id = ? order by created_at desc", [$id]);

            foreach($logs as $key => $item ){
                $logs[$key]->items = DB::select("select * from user_log WHERE user_id = ? and created_at::date = ?  order by created_at desc", [$id,$item->created_at]);
            }
        }else{
            $logs = DB::select("select distinct(to_date(created_at,'%Y-%m-%d')) as created_at from user_log WHERE user_id = ? order by created_at desc", [$id]);

            foreach($logs as $key => $item ){
                $logs[$key]->items = DB::select("select * from user_log WHERE user_id = ? and date_format(created_at,'%Y-%m-%d') = ?  order by created_at desc", [$id,$item->created_at]);
            }
        }



        return view($this->controller.'.activity',['content'=>$user,'logs'=>$logs]);
    }

    public function getSocials($id)
    {
        $content = $this->model->findOrFail($id);

        return view($this->controller.'.socials',compact('content'));
    }
}