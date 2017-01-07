<?php namespace App\Helpers;

use App\Content;
use App\Gallery;
use App\SiteUser;
use App\User;

class Comments {

    protected $treeHTML;

    protected $templateMain = '';

    protected $templateSingle = '';

    protected $templateMulti ='';

    protected $countComments = 0;

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof Comments)
            return self::$instance;

        self::$instance =  new Comments();
        return self::$instance;
    }

    private function __construct()
    {
        $this->templateSingle = view('comments.template.single')->render();
        $this->templateMulti = view('comments.template.multi')->render();
        $this->templateMain = view('comments.template.main')->render();
    }

    public function getView($content_id,$type='content')
    {
        view()->share('content_id',$content_id);

        $items = \App\Comments::where('content_id',$content_id)->where('type',$type)->orderBy('created_at','desc')->get();


        $items->linkNodes();

        foreach($items as $key=>$item) $items[$key]->date = $item->created_at->diffForHumans();


        $items = $items->toArray();

        $list = $this->view($items);



        view()->share('commentsList',$list);
        if($type == 'gallery'){
            view()->share('dataContent',Gallery::find($content_id));
        }
        if($type == 'content'){
            view()->share('dataContent',Content::find($content_id));
        }

        view()->share('countComments',$this->countComments);
        return view('comments.list');
    }

    public function view($items){

        foreach($items as $key=>$item)
            if($item['parent_id'])
                unset($items[$key]);

        $this->move($items);

        return str_replace('{val}',$this->treeHTML,$this->templateMain);
    }


    protected function move($items){

        foreach($items as $item){
            if(!empty($item['children'])){
                $template = explode('{|}',$this->templateMulti);
                $str = str_replace('{id}',$item['id'],$template[0]);
                $str = str_replace('{status}',$item['status'],$str);
                $st_name = \Config::get('admin.status_comments')[$item['status']]['name'];
                $str = str_replace('{status_name}',trans('app.'.$st_name),$str);

                $bg = \Config::get('admin.status_comments')[$item['status']]['bg'];
                $str = str_replace('{status_bg}',$bg,$str);
                $str = str_replace('{comment}',$item['comment'],$str);
                $str = str_replace('{date}',$item['date'],$str);
                $str = str_replace('{date_full}',date('c',strtotime($item['created_at'])),$str);

                if($item['ip']=== null){
                    if($item['user_id'] === null){
                        $str = str_replace('{avatar}','/img/design/avatar.png',$str);
                        if($item['name'])
                            $str = str_replace('{user_name}',$item['name'],$str);
                        else
                            $str = str_replace('{user_name}',Main::constant('name'),$str);


                    }else{
                        $user =User::where('id',$item['user_id'])->first();
                        $image = ($user->image)? MediaImage::getThumbsImage($user->image,64,64,['crop'=>$user->is_crop]) : '/img/design/avatar.png';
                        $str = str_replace('{avatar}',$image,$str);
                        $str = str_replace('{user_name}',$item['name'],$str);
                    }

                }else {
                    $str = str_replace('{user_name}',$item['name'],$str);
                    if ($item['user_id'] !== null) {
                        $user = SiteUser::find($item['user_id']);
                        if ($user !== null) {
                            $social = $user->socials()->where('name', $user->social_network)->first();
                            if (isset($social->photo) && $social->photo !== null)
                                $str = str_replace('{avatar}', \Config::get('admin.image_url').$social->photo, $str);
                            else
                                $str = str_replace('{avatar}',  \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg' , $str);
                        } else {
                            $str = str_replace('{avatar}',  \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg', $str);
                        }
                    } else {
                        $str = str_replace('{avatar}', \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg', $str);
                    }
                }


                $this->countComments ++;
                $this->treeHTML.= $str;
                $this->move(Main::array_orderby($item['children'],'id'));
                $this->treeHTML .=$template[1];
            }else{
                $str = str_replace('{id}',$item['id'],$this->templateSingle);
                $str = str_replace('{comment}',$item['comment'],$str);
                $str = str_replace('{date}',$item['date'],$str);
                $str = str_replace('{date_full}',date('c',strtotime($item['created_at'])),$str);
                $str = str_replace('{status}',$item['status'],$str);
                $st_name = \Config::get('admin.status_comments')[$item['status']]['name'];
                $str = str_replace('{status_name}',trans('app.'.$st_name),$str);
                $bg = \Config::get('admin.status_comments')[$item['status']]['bg'];
                $str = str_replace('{status_bg}',$bg,$str);


                if($item['ip']=== null){
                    if($item['user_id'] === null){
                        $str = str_replace('{avatar}','/img/design/avatar.png',$str);
                        if($item['name'])
                            $str = str_replace('{user_name}',$item['name'],$str);
                        else
                            $str = str_replace('{user_name}',Main::constant('name'),$str);


                    }else{
                        $user =User::where('id',$item['user_id'])->first();
                        $image = ($user->image)? MediaImage::getThumbsImage($user->image,64,64,['crop'=>$user->is_crop]) : '/img/design/avatar.png';
                        $str = str_replace('{avatar}',$image,$str);
                        $str = str_replace('{user_name}',$item['name'],$str);
                    }

                }else {
                    $str = str_replace('{user_name}',$item['name'],$str);
                    if ($item['user_id'] !== null) {
                        $user = SiteUser::find($item['user_id']);
                        if ($user !== null) {
                            $social = $user->socials()->where('name', $user->social_network)->first();
                            if (isset($social->photo) && $social->photo !== null)
                                $str = str_replace('{avatar}', \Config::get('admin.image_url').$social->photo, $str);
                            else
                                $str = str_replace('{avatar}',  \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg', $str);
                        } else {
                            $str = str_replace('{avatar}',  \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg', $str);
                        }
                    } else {
                        $str = str_replace('{avatar}', \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg', $str);
                    }
                }

                $this->countComments ++;
                $this->treeHTML.= $str;
            }
        }
    }

}