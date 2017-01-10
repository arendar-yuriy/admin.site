<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use App\Permission;

class PermissionsController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.Permission');
        $this->model = new Permission();
        $this->controller = 'permissions';
        $this->actionGroupDeselect = false;
        $this->actionGroupActive = false;

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
     * Create new record in database for current parts of admin application
     * @param Request $request
     * @return array|string
     */
    public function postStore(PermissionRequest $request)
    {
        $data = $request->all();
        $this->validation->mergeRules('name','unique:permissions');

        if($this->validation->fails())
            return $this->validation->errors()->toJson();

        $content = $this->model->create($data);

        return Main::redirect(
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
    public function postUpdate(PermissionRequest $request,$id)
    {
        $content = $this->model->find($id);
        $data = $request->all();

        foreach($data as $name=>$item)
            $content->{$name} = $item;

        $content->save();

        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success'
        );
    }
}