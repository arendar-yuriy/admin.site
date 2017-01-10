<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Content;
use App\ContentStructure;
use App\Gallery;
use App\Helpers\Main;
use App\Structure;
use Illuminate\Http\Request;
use App\Http\Requests;


class CommentsController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->title = trans('app.comments');
        $this->controller = 'comments';
        $this->model = new Comments();

        parent::__construct($request);
    }

    /**
     * Main action for current part of admin application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $id = \Route::current()->parameter('id');
        $type = \Route::current()->parameter('type');

        if($id === null){
            if ($type === null){
                $comment = $this->model->orderBy('created_at','desc')->first();
                if ($comment === null) return view($this->controller.'.empty');
                $id = $comment->content_id;
                $type = $comment->type;
            }
            else{
                $comment = $this->model->where('type',$type)->orderBy('created_at','desc')->first();
                if ($comment === null) return view($this->controller.'.empty');
                $id = $comment->content_id;
            }
        }

        if($type=='content'){

            $content = Content::find($id);

            if($content === null) return view($this->controller.'.empty');

        }

        if($type=='gallery'){

            $content = Gallery::find($id);

            if($content === null) return view($this->controller.'.empty');
        }

        $content_id = $this->model->where('type','content')->distinct()->pluck('content_id')->toArray();

        $structures = ContentStructure::whereIn('content_id',$content_id)->distinct()->pluck('structure_id')->toArray();

        $structures = Structure::whereIn('id',$structures)->get();

        view()->share('listStructures',$structures);

        $content_id = $this->model->where('type','gallery')->distinct()->pluck('content_id')->toArray();

        $structures = Gallery::whereIn('id',$content_id)->get();

        view()->share('listGallery',$structures);


        return view($this->controller.'.index',['content_id'=>$id,'type'=>$type]);
    }

    public function postGetForm(Request $request){
        $id = $request->get('id');
        $type = $request->get('type');

        $content = $this->model->find($id);

        return view($this->controller.'.edit')->with([
            'content'=>$content,
            'type'=>$type
        ]);
    }


    public function getForm(Request $request){
        $parent_id = $request->get('parent_id');
        $content_id = $request->get('content_id');
        $type = $request->get('type');
        return view($this->controller.'.create',['content_id'=>$content_id,'parent_id'=>$parent_id,'type'=>$type]);
    }


    public function postStore(Requests\CommentRequest $request)
    {
        $this->model->create([
            'comment'=>$request->get('comment'),
            'locale'=>\LaravelLocalization::getCurrentLocale(),
            'status'=>'confirmed',
            'name'=>\Auth::user()->name,
            'user_id'=> \Auth::user()->id,
            'type'=>$request->get('type'),
            'content_id'=>$request->get('content_id'),
            'parent_id'=>$request->get('parent_id')
        ]);

        return redirectApp('','302',trans('app.answer was send'),trans('app.Submit'),'success');
    }


    public function postUpdate(Request $request, $id)
    {
        $data = $this->model->find($id);
        $data->status = $request->get('status');
        $data->comment = $request->get('comment');
        $data->save();
        return redirectApp('','302',trans('app.data saved'),trans('app.Saved'),'success');
    }

}
