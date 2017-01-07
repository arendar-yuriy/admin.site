<?php

namespace App\Http\Controllers;

use App\Helpers\Main;
use App\Helpers\Table;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;

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
    public function postStore(Request $request)
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
}