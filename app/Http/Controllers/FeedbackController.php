<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Helpers\Main;
use App\Helpers\Table;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.feedback');
        $this->model = new Feedback();
        $this->controller = 'feedback';
        $this->isMultiLang = false;
        $this->columns = [
            'edit'=>[
                'order'=>false,
                'type'=>'edit',
            ],
            'status'=>[
                'order'=>true,
                'type'=>'status',
            ],
            'name'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'email'=>[
                'order'=>true,
                'type'=>'default',
            ],
            'subject'=>[
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

    /**
     * Main action for current part of admin application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $table = new Table();
        $table->dataModel = $this->model;
        $table->isMultiLang  = $this->isMultiLang;
        $table->actionGroupDeselect = false;
        $table->actionGroupActive = false;

        $table->columns  = $this->columns;

        $table->controller = $this->controller;
        $data['data'] = $this->model->orderBy('created_at', 'desc')->get()->toArray();

        $data['header'] = $table->columns;
        $table =  $table->getView($data);

        return view($this->controller.'.index',['table'=>$table]);
    }

    public function postUpdate(Request $request, $id)
    {
        $status = $request->get('status');
        $answer = $request->get('answer');
        if($answer){

        }
        $content = $this->model->find($id);
        $content->answer = $answer;
        $content->status = $status;
        $content->save();
        return Main::redirect(
            Route('edit_'.$this->controller,['id'=>$content->id]),
            '302',trans('app.data saved'),trans('app.Saved'),'success');
    }
}
