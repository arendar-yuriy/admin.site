<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Helpers\Table;
use App\Http\Requests\RolesRequest;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;

class RolesController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.Roles');
        $this->model = new Role();
        $this->controller = 'roles';

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
            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'display_name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'description'=>[
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = new Table();
        $table->dataModel = $this->model;
        $table->isMultiLang  = $this->isMultiLang;
        $table->actionGroupDeselect = false;
        $table->actionGroupActive = false;

        $table->columns  = $this->columns;

        $data['data'] = $this->model->orderBy('created_at', 'desc')->get()->toArray();

        $table->controller = $this->controller;
        $data['header'] = $table->columns;
        $table =  $table->getView($data);

        return view($this->controller.'.index',['table'=>$table]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        $permission = Permission::get()->toArray();
        $permission = array_chunk($permission,2);
        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(RolesRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$role->id]),
            '302',trans('app.item was created'),trans('app.Role created successfully'),'success'
        );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $content = $this->model->find($id);
        $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->pluck('id')->toArray();

        $permission = Permission::get()->toArray();

        $permission = array_chunk($permission,2);

        return view('roles.edit',compact('content','rolePermissions','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(RolesRequest $request, $id)
    {
        $role = Role::find($id);
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$role->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }
}