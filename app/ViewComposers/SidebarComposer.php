<?php

namespace App\ViewComposers;

use App\Content;
use App\Gallery;
use App\Helpers\FormLang;
use App\Helpers\Main;
use App\Helpers\TreeBuilder;
use App\Structure;
use Illuminate\View\View;

class SidebarComposer
{

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $views)
    {
        $controller = getControllerName();
        $route = \Route::current();

        $build = new TreeBuilder();
        $lang = \LaravelLocalization::getCurrentLocale();
        \LaravelLocalization::setLocale(FormLang::getCurrentLang());
        $structures = Structure::all()->sortBy('position');

        foreach ($structures as $key=>$struct) {
            if($struct->name == '')
                $struct->name = $struct->id;
            $structures[$key]->link = route('content',['structure_id'=>$struct->id]);
        }

        $structures->linkNodes();

        $str =  $structures->toArray();

        if($route !== null and $route->parameter('structure_id'))
        {
            $struct = Structure::find(\Route::current()->parameter('structure_id'));
        }elseif($route !== null and $route->parameter('id') && $controller == 'ContentController'){
            $struct =Content::find(\Route::current()->parameter('id'))->structures()->first();
        }else{
            $struct = null;
        }

        if($struct)
            $build->active = $struct->id;

        $view = $build->view(
            $str,
            '<li '.(($controller == 'ContentController')?'class="active"':'').'><a href="#"><i class="icon-files-empty"></i><span>'.trans('app.content').'</span></a><ul>{val}</ul></li>',
            '<li {active} ><a href="{link}">{icon}{name}</a></li>',
            '<li ><a href="#"><i class=" icon-folder-open"></i>{name}</a><ul>{|}</ul></li>'
        );

        $tree_folders = new TreeBuilder();



        $folders = Gallery::all()->sortBy('position');

        foreach($folders as $key=>$folder){
            if($folder->name == '')
                $folder->name = $folder->id;
            $folders[$key]->link = route('edit_gallery',['id'=>$folder->id]);
        }

        $folders->linkNodes();

        $str = $folders->toArray();


        if($controller == 'GalleryController' && \Route::current()->parameter('id') !== null){
            $oFolder = Gallery::find(\Route::current()->parameter('id'));
        }

        if(isset($oFolder) && $oFolder !== null)
            $tree_folders->active = $oFolder->id;

        $folder_view = $tree_folders->view(
            $str,
            '<li '.(($controller == 'GalleryController')?'class="active"':'').'><a href="#"><i class="icon-images2"></i> <span>'.trans('app.gallery').'</span></a><ul>{val}</ul></li>',
            '<li {active} ><a href="{link}"> {name}</a></li>',
            '<li {active}><a href="#"><i class=" icon-folder-open"></i>{name}</a><ul>{|}</ul></li>'
        );

        \LaravelLocalization::setLocale($lang);

        $views->with([
            'tree_structure'=>$view,
            'tree_folders'=>$folder_view,
            'classController'=>$controller,
            'title'=>trans('app.Admin application'),
            'controller'=>null
        ]);
    }
}