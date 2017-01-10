<?php


/**
 * Structure
 */
Breadcrumbs::register('structure', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.structure'), route('structure'));

});

Breadcrumbs::register('structure_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.structure'), route('structure'));

    $breadcrumbs->push(trans('app.add_structure'), route('structure_add'));
});

Breadcrumbs::register('edit_structure', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.structure'), route('structure'));

    $id = Route::current()->getParameter('id');

    $content = \App\Structure::find($id);
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    $id = Route::current()->getParameter('id');
    $category = \App\Structure::find($id);
    $listCategory =$category->ancestors()->get();
    foreach($listCategory as $cat){
        $breadcrumbs->push($cat->name, route('edit_structure',['id'=>$cat->id]));
    }
    $breadcrumbs->push($content_translate->name, route('edit_structure',['id'=>$id]));

});

Breadcrumbs::register('structure_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.structure'), route('structure'));

    $id = Route::current()->getParameter('id');

    $content = \App\Structure::find($id);
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    $id = Route::current()->getParameter('id');
    $category = \App\Structure::find($id);
    $listCategory =$category->ancestors()->get();
    foreach($listCategory as $cat){
        $breadcrumbs->push($cat->name, route('edit_structure',['id'=>$cat->id]));
    }
    $breadcrumbs->push($content_translate->name, route('edit_structure',['id'=>$id]));
    $breadcrumbs->push($content_translate->name.': '.trans('app.Crop image'), route('structure_crop_view',['id'=>$id]));

});

/**
 * Blocks
 */

Breadcrumbs::register('blocks', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.blocks'), route('blocks'));
});

Breadcrumbs::register('blocks_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.blocks'), route('blocks'));

    $breadcrumbs->push(trans('app.add_block'), route('blocks_add'));
});

Breadcrumbs::register('edit_blocks', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.blocks'), route('blocks'));

    $id = Route::current()->getParameter('id');

    $content = \App\Content::find($id);
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    //dd($content_translate);
    $breadcrumbs->push($content_translate->name, route('edit_blocks',['id'=>$id]));

});

Breadcrumbs::register('blocks_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.blocks'), route('blocks'));

    $id = Route::current()->getParameter('id');

    $content = \App\Content::find($id);
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    //dd($content_translate);
    $breadcrumbs->push($content_translate->name, route('edit_blocks',['id'=>$id]));
    $breadcrumbs->push($content_translate->name.': '.trans('app.Crop image'), route('blocks_crop_view',['id'=>$id]));

});

/**
 * Tags
 */

Breadcrumbs::register('tags', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.tags'), route('tags'));
});


Breadcrumbs::register('edit_tags', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.tags'), route('tags'));

    $id = Route::current()->getParameter('id');

    $content = \App\Tag::find($id);

    $breadcrumbs->push($content->text, route('edit_tags',['id'=>$id]));

});

/**
 * Feedback
 */
Breadcrumbs::register('feedback', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.feedback'), route('feedback'));
});


Breadcrumbs::register('edit_feedback', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.feedback'), route('feedback'));

    $id = Route::current()->getParameter('id');

    $content = \App\Feedback::find($id);

    $breadcrumbs->push($content->name, route('edit_tags',['id'=>$id]));

});

/**
 * Comments
 */

Breadcrumbs::register('comments', function($breadcrumbs)
{
    $id = Route::current()->getParameter('id');
    $type = Route::current()->parameter('type');
    $breadcrumbs->push(trans('app.comments'), route('comments',['type'=>$type]));
    if($id===null){

        if ($type === null){
            $comment = \App\Comments::orderBy('created_at','desc')->first();
            if ($comment !== null){
                $id = $comment->content_id;
                $type = $comment->type;
            }

        }
        else{
            $comment = \App\Comments::where('type',$type)->orderBy('created_at','desc')->first();
            if ($comment !== null){
                $id = $comment->content_id;
            }
        }


        if($type == 'content')
            $content = \App\Content::find($id);
        if($type == 'gallery')
            $content = \App\Gallery::find($id);

        if(isset($content) && $content !== null)
            $breadcrumbs->push($content->name, route('comments',['id'=>$content->id,'type'=>$type]));
    }else{
        if($type == 'content')
            $content = \App\Content::find($id);
        if($type == 'gallery')
            $content = \App\Gallery::find($id);
        $breadcrumbs->push($content->name, route('comments',['id'=>$content->id,'type'=>$type]));
    }

});


/**
 * Content
 */

Breadcrumbs::register('content', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.content'), route('content'));
    $category_id = Route::current()->getParameter('structure_id');
    if($category_id){
        $category = \App\Structure::find($category_id);

        $breadcrumbs->push($category->name, route('content',['structure_id'=>$category->id]));
    }

});

Breadcrumbs::register('content_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.content'), route('content'));
    $category_id = Route::current()->getParameter('structure_id');
    $category = \App\Structure::find($category_id);
    $breadcrumbs->push($category->name, route('content',['strucutre_id'=>$category->id]));
    $breadcrumbs->push(trans('app.add_content'), route('content_add',['strucutre_id'=>$category->id]));
});

Breadcrumbs::register('edit_content', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.content'), route('content'));

    $id = Route::current()->getParameter('id');

    $content = \App\Content::find($id);
    $category = $content->structures()->get();
    $category = $category[0];

    $breadcrumbs->push($category->name, route('content',['structure_id'=>$category->id]));
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    //dd($content_translate);
    $breadcrumbs->push($content_translate->name, route('edit_content',['id'=>$id]));

});

Breadcrumbs::register('content_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.content'), route('content'));

    $id = Route::current()->getParameter('id');

    $content = \App\Content::find($id);
    $category = $content->structures()->get();
    $category = $category[0];

    $breadcrumbs->push($category->name, route('content',['structure_id'=>$category->id]));
    $content_translate = $content->translate(\App\Helpers\FormLang::getCurrentLang());
    //dd($content_translate);
    $breadcrumbs->push($content_translate->name, route('edit_content',['id'=>$id]));
    $breadcrumbs->push($content_translate->name.': '.trans('app.Crop image'), route('content_crop_view',['id'=>$id]));

});

/**
 * Gallery
 */


Breadcrumbs::register('gallery', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');
    if($id !== null){
        $folder = \App\Gallery::find($id);

        $listFolder = $folder->ancestors()->get();
        foreach($listFolder as $item){
            $breadcrumbs->push($item->name, route('gallery',['id'=>$item->id]));
        }
        $breadcrumbs->push($folder->name, route('gallery',['id'=>$folder->id]));
    }

});

Breadcrumbs::register('edit_gallery', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');

    $folder = \App\Gallery::find($id);

    $listFolder = $folder->ancestors()->get();
    foreach($listFolder as $item){
        $breadcrumbs->push($item->name, route('edit_gallery',['id'=>$item->id]));
    }
    $breadcrumbs->push($folder->name, route('edit_gallery',['id'=>$folder->id]));
});

Breadcrumbs::register('gallery_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');

    $folder = \App\Gallery::find($id);

    if($folder !== null){
        $listFolder = $folder->ancestors()->get();
        foreach($listFolder as $item){
            $breadcrumbs->push($item->name, route('edit_gallery',['id'=>$item->id]));
        }
        $breadcrumbs->push($folder->name, route('edit_gallery',['id'=>$folder->id]));
    }

    $breadcrumbs->push(trans('app.add_gallery_folder'), route('gallery_add',['id'=>$folder->id]));
});

Breadcrumbs::register('gallery_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');

    $folder = \App\Gallery::find($id);

    $listFolder = $folder->ancestors()->get();
    foreach($listFolder as $item){
        $breadcrumbs->push($item->name, route('edit_gallery',['id'=>$item->id]));
    }
    $breadcrumbs->push($folder->name, route('edit_gallery',['id'=>$folder->id]));
    $breadcrumbs->push($folder->name.': '.trans('app.Crop image'), route('gallery_crop_view',['id'=>$folder->id]));
});

Breadcrumbs::register('edit_image_gallery', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');

    $image = \App\GalleryUnit::find($id);

    if(!$image->name){
        $image->name = $image->id;
    }

    $folder = \App\Gallery::find($image->gallery_id);

    $listFolder = $folder->ancestors()->get();
    foreach($listFolder as $item){
        $breadcrumbs->push($item->name, route('edit_gallery',['id'=>$item->id]));
    }
    $breadcrumbs->push($folder->name, route('edit_gallery',['id'=>$folder->id]));

    $breadcrumbs->push(trans('app.edit image').': '.$image->name, route('edit_image_gallery',['id'=>$image->id]));
});

Breadcrumbs::register('gallery_unit_crop_edit', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.gallery'), route('gallery'));

    $id = Route::current()->parameter('id');

    $image = \App\GalleryUnit::find($id);

    if(!$image->name){
        $image->name = $image->id;
    }

    $folder = \App\Gallery::find($image->gallery_id);

    $listFolder = $folder->ancestors()->get();
    foreach($listFolder as $item){
        $breadcrumbs->push($item->name, route('edit_gallery',['id'=>$item->id]));
    }
    $breadcrumbs->push($folder->name, route('edit_gallery',['id'=>$folder->id]));

    $breadcrumbs->push(trans('app.crop image').': '.$image->name, route('gallery_unit_crop_edit',['id'=>$image->id]));
});

/**
 * Constants
 */

Breadcrumbs::register('constants', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.constants'), route('constants'));

    $group = Route::current()->getParameter('group');

    if($group !== null)
        $breadcrumbs->push(trans('constant.'.Config::get('admin.constants_group.'.$group)), route('constants',['group'=>$group]));

});

Breadcrumbs::register('constants_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.constants'), route('constants'));

    $group = Route::current()->getParameter('group');

    if($group !== null)
        $breadcrumbs->push(trans('constant.'.Config::get('admin.constants_group.'.$group)), route('constants',['group'=>$group]));

    $type = Route::current()->getParameter('type');

    $breadcrumbs->push(trans('constant.'.Config::get('admin.constants_type.'.$type)), route('constants_add',['group'=>$group,'type'=>$type]));

});

/**
 * Roles
 */

Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Roles'), route('roles'));

});

Breadcrumbs::register('roles_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Roles'), route('roles'));

    $breadcrumbs->push(trans('app.add_roles'), route('roles_add'));

});

Breadcrumbs::register('edit_roles', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Roles'), route('roles'));

    $id = Route::current()->parameter('id');

    $role = \App\Role::find($id);

    $breadcrumbs->push(trans('app.edit_roles').': '.$role->display_name, route('edit_roles',['id'=>$id]));

});

/**
 * Permissions
 */

Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Permissions'), route('permissions'));

});

Breadcrumbs::register('permissions_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Permissions'), route('permissions'));

    $breadcrumbs->push(trans('app.add_permissions'), route('permissions_add'));

});

Breadcrumbs::register('edit_permissions', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Permissions'), route('permissions'));

    $id = Route::current()->parameter('id');

    $role = \App\Permission::find($id);

    $breadcrumbs->push($role->display_name, route('edit_permissions',['id'=>$id]));

});

/**
 * Users
 */

Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

});

Breadcrumbs::register('users_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

    $breadcrumbs->push(trans('app.add_users'), route('users_add'));

});

Breadcrumbs::register('edit_users', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

    $id = Route::current()->parameter('id');

    $user = \App\User::find($id);

    $breadcrumbs->push($user->name.' '.$user->lastname, route('edit_users',['id'=>$id]));

});

Breadcrumbs::register('edit_users_passwords', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

    $id = Route::current()->parameter('id');

    $user = \App\User::find($id);

    $breadcrumbs->push($user->name.' '.$user->lastname, route('edit_users',['id'=>$id]));

    $breadcrumbs->push(trans('app.Change password'), route('edit_users_passwords',['id'=>$id]));

});

Breadcrumbs::register('users_activity', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

    $id = Route::current()->parameter('id');

    $user = \App\User::find($id);

    $breadcrumbs->push($user->name.' '.$user->lastname, route('edit_users',['id'=>$id]));

    $breadcrumbs->push(trans('activity.User activity'), route('users_activity',['id'=>$id]));

});


Breadcrumbs::register('users_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Users'), route('users'));

    $id = Route::current()->parameter('id');

    $user = \App\User::find($id);

    $breadcrumbs->push($user->name.' '.$user->lastname, route('edit_users',['id'=>$id]));

    $breadcrumbs->push(trans('app.Crop image'), route('users_crop_view',['id'=>$id]));

});


/**
 * Basket
 */
Breadcrumbs::register('basket', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Basket'), route('basket'));
});

Breadcrumbs::register('siteusers', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

});

/**
 * Site users
 */

Breadcrumbs::register('edit_siteusers', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

    $id = Route::current()->parameter('id');

    $user = \App\SiteUser::find($id);

    $breadcrumbs->push($user->name, route('edit_siteusers',['id'=>$id]));

});

Breadcrumbs::register('edit_siteusers_passwords', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

    $id = Route::current()->parameter('id');

    $user = \App\SiteUser::find($id);

    $breadcrumbs->push($user->name, route('edit_siteusers',['id'=>$id]));

    $breadcrumbs->push(trans('app.Change password'), route('edit_siteusers_passwords',['id'=>$id]));

});

Breadcrumbs::register('siteusers_activity', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

    $id = Route::current()->parameter('id');

    $user = \App\SiteUser::find($id);

    $breadcrumbs->push($user->name, route('edit_siteusers',['id'=>$id]));

    $breadcrumbs->push(trans('activity.User activity'), route('siteusers_activity',['id'=>$id]));

});

Breadcrumbs::register('siteusers_socials', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

    $id = Route::current()->parameter('id');

    $user = \App\SiteUser::find($id);

    $breadcrumbs->push($user->name, route('edit_siteusers',['id'=>$id]));

    $breadcrumbs->push(trans('app.Social networks'), route('siteusers_socials',['id'=>$id]));

});

Breadcrumbs::register('siteusers_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Site Users'), route('siteusers'));

    $breadcrumbs->push(trans('app.add_users'), route('siteusers_add'));

});

/**
 * Sliders
 */

Breadcrumbs::register('sliders', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));
});

Breadcrumbs::register('sliders_add', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));

    $breadcrumbs->push(trans('app.add_sliders'), route('sliders_add'));

});

Breadcrumbs::register('edit_sliders', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));

    $id = Route::current()->parameter('id');

    $role = \App\Sliders::find($id);

    $breadcrumbs->push($role->name, route('edit_sliders',['id'=>$id]));

});

Breadcrumbs::register('edit_sliders_unit', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));

    $id = Route::current()->parameter('id');

    $unit = \App\SliderUnits::find($id);

    $breadcrumbs->push($unit->slider->name, route('edit_sliders',['id'=>$unit->slider->id]));

    $breadcrumbs->push($unit->name, route('edit_sliders_unit',['id'=>$id]));

});

Breadcrumbs::register('sliders_add_unit', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));

    $id = Route::current()->parameter('id');

    $slider = \App\Sliders::find($id);

    $breadcrumbs->push($slider->name, route('edit_sliders',['id'=>$slider->id]));

    $breadcrumbs->push(trans('app.Add new slide'), route('sliders_add_unit',['id'=>$id]));

});

Breadcrumbs::register('sliders_crop_view', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.Sliders'), route('sliders'));

    $id = Route::current()->parameter('id');

    $unit = \App\SliderUnits::find($id);

    $breadcrumbs->push($unit->slider->name, route('edit_sliders',['id'=>$unit->slider->id]));

    $breadcrumbs->push($unit->name, route('edit_sliders_unit',['id'=>$id]));

    $breadcrumbs->push($unit->name.': '.trans('app.Crop image'), route('sliders_crop_view',['id'=>$id]));

});
