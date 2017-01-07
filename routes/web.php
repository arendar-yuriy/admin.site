<?php

Route::group(['middleware' => 'web'], function () {

    //Auth::routes();

    Route::get('login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('login','Auth\LoginController@login')->name('in');
    Route::get('logout','Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth','localeSessionRedirect', 'localizationRedirect'],'prefix' => LaravelLocalization::setLocale()], function () {
        // смена языка редактируемого контента
        Route::post('language-form','AjaxController@postChangeLang')->name('change_form_language');
        // упраление изображениями с dropzone
        Route::post('upload-image','DropzoneController@postUploadImage')->name('upload_image_form');

        Route::post('/image/upload/{type}',  'DropzoneController@postUpload')->name('image_upload');

        Route::post('/image/delete/{type}/{id}', 'DropzoneController@postDelete')->name('image_delete');

        Route::post('/crop/view', 'CropController@postGetView')->name('crop_view');
        // Главная страница
        Route::get('/', 'IndexController@index')->middleware('permission:index-view');



        /**
         * group gallery routs
         */
        Route::group(['prefix' => 'gallery'], function () {
            Route::post('action/delete', 'GalleryController@postGroupDelete')
                ->name('group_delete_gallery')
                ->middleware(['permission:gallery-add-delete']);

            Route::post('action/active', 'GalleryController@postGroupActive')
                ->name('group_active_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('action/deselect', 'GalleryController@postGroupDeselectActive')
                ->name('group_deselect_active_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            //units actions

            Route::post('action/units/delete', 'GalleryController@postGroupDeleteUnits')
                ->name('group_delete_gallery')
                ->middleware(['permission:gallery-add-delete']);

            Route::post('action/units/active', 'GalleryController@postGroupActiveUnits')
                ->name('group_active_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('action/units/deselect', 'GalleryController@postGroupDeselectActiveUnits')
                ->name('group_deselect_active_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('unit/crop/{id}', 'GalleryController@postCropUnit')
                ->name('gallery_unit_crop')
                ->middleware( ['permission:gallery-add-delete|gallery-edit']);

            Route::get('unit/crop/{id}', 'GalleryController@getCropUnitImage')
                ->name('gallery_unit_crop_edit')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            //end units actions

            Route::get('add/{id?}', 'GalleryController@getAdd')
                ->name('gallery_add')
                ->middleware(['permission:gallery-add-delete']);

            Route::post('add/{id?}', 'GalleryController@postStore')
                ->name('add_new_folder')
                ->middleware(['permission:gallery-add-delete']);

            Route::get('{id?}','GalleryController@index')
                ->name('gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit|gallery-view']);

            Route::post('image/{id}','GalleryController@image')
                ->name('gallery_image')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('edit/{id}','GalleryController@getEdit')
                ->name('edit_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit|gallery-view']);

            Route::get('active/{id}','GalleryController@getActive')
                ->name('active_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('delete/{id}','GalleryController@getDelete')
                ->name('delete_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('edit/{id}', 'GalleryController@postUpdate')
                ->name('update_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('image/edit/{id}', 'GalleryController@getEditImage')
                ->name('edit_image_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('image/edit/{id}', 'GalleryController@postImageUpdate')
                ->name('update_image_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('image/active/{id}','GalleryController@getImageActive')
                ->name('active_image_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('image/delete/{id}','GalleryController@getImageDelete')
                ->name('delete_image_gallery')
                ->middleware(['permission:gallery-add-delete']);

            Route::post('meta/{id}','GalleryController@postMeta')->name('meta_gallery');

            Route::post('crop/{id}', 'GalleryController@postCropImage')
                ->name('gallery_crop')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::get('crop/view/{id}', 'GalleryController@getGetView')
                ->name('gallery_crop_view')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('crop/view/{id}','GalleryController@postGetView')
                ->name('gallery_crop_view_post')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);

            Route::post('position/{id}', 'GalleryController@postPosition')
                ->name('update_position_gallery')
                ->middleware(['permission:gallery-add-delete|gallery-edit']);
        });



        /**
         * group structure routs
         */

        Route::group(['prefix' => 'structure'], function () {
            Route::get('/', 'StructureController@index')
                ->name('structure')
                ->middleware( ['permission:structure-add-delete|structure-edit|structure-view']);

            Route::post('rebuild','StructureController@postRebuild')
                ->name('rebuild_structure')
                ->middleware( ['permission:structure-add-delete|structure-edit']);

            Route::get('add','StructureController@getAdd')
                ->name('structure_add')
                ->middleware(['permission:structure-add-delete']);

            Route::post('add','StructureController@postStore')
                ->name('add_new_structure')
                ->middleware( ['permission:structure-add-delete']);

            Route::get('edit/{id}', 'StructureController@getEdit')
                ->name('edit_structure')
                ->middleware(['permission:structure-add-delete|structure-edit|structure-view']);

            Route::get('active/{id}', 'StructureController@getActive')
                ->name('active_structure')
                ->middleware(['permission:structure-add-delete|structure-edit']);

            Route::get('delete/{id}', 'StructureController@getDelete')
                ->name('delete_structure')
                ->middleware(['permission:structure-add-delete']);

            Route::post('edit/{id}','StructureController@postUpdate')
                ->name('update_structure')
                ->middleware( ['permission:structure-add-delete|structure-edit']);

            Route::post('meta/{id}', 'StructureController@postMeta')
                ->name('meta_structure')
                ->middleware( ['permission:structure-add-delete|structure-edit']);

            Route::post('crop/{id}','StructureController@postCropImage')
                ->name('structure_crop')
                ->middleware(['permission:structure-add-delete|structure-edit']);

            Route::get('crop/view/{id}', 'StructureController@getGetView')
                ->name('structure_crop_view')
                ->middleware(['permission:structure-add-delete|structure-edit']);

            Route::post('crop/view/{id}','StructureController@postGetView')
                ->middleware( ['permission:structure-add-delete|structure-edit'])
                ->name('structure_crop_view_post');
        });


        /**
         * group content routs
         */

        Route::group(['prefix' => 'content'], function () {
            Route::post('action/delete', 'ContentController@postGroupDelete')
                ->name('group_delete_content')
                ->middleware(['permission:content-add-delete']);

            Route::post('action/active', 'ContentController@postGroupActive')
                ->name('group_active_content')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::post('action/deselect', 'ContentController@postGroupDeselectActive')
                ->name('group_deselect_active_content')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::get('{structure_id}/add','ContentController@getAdd')
                ->name('content_add')
                ->middleware(['permission:content-add-delete']);

            Route::post('{structure_id}/add', 'ContentController@postStore')
                ->name('add_new_content')
                ->middleware(['permission:content-add-delete']);

            Route::post('position/{id}', 'ContentController@postPosition')
                ->name('update_position_content')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::get('edit/{id}','ContentController@getEdit')
                ->middleware( ['permission:content-add-delete|content-edit|content-view'])
                ->name('edit_content');

            Route::get('active/{id}','ContentController@getActive')
                ->name('active_content')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::get('delete/{id}', 'ContentController@getDelete')
                ->name('delete_content')
                ->middleware(['permission:content-add-delete']);

            Route::post('edit/{id}','ContentController@postUpdate')
                ->name('update_content')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::get('{structure_id?}', 'ContentController@index')
                ->name('content')
                ->middleware(['permission:content-add-delete|content-edit|content-view']);

            Route::post('image/{id}', 'ContentController@image')
                ->name('content_image')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::post('crop/{id}', 'ContentController@postCropImage')
                ->name('content_crop')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::get('crop/view/{id}', 'ContentController@getGetView')
                ->name('content_crop_view')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::post('crop/view/{id}','ContentController@postGetView')
                ->name('content_crop_view_post')
                ->middleware(['permission:content-add-delete|content-edit']);

            Route::post('meta/{id}','ContentController@postMeta')
                ->middleware(['permission:content-add-delete|content-edit'])
                ->name('meta_content');
        });


        /**
         * group text bloks routs
         */

        Route::group(['prefix' => 'blocks'], function () {
            Route::post('action/delete', 'BlocksController@postGroupDelete')
                ->name('group_delete_blocks')
                ->middleware(['permission:blocks-add-delete']);

            Route::post('action/active', 'BlocksController@postGroupActive')
                ->name('group_active_blocks')
                ->middleware(['permission:blocks-add-delete|blocks-edit']);

            Route::post('action/deselect', 'BlocksController@postGroupDeselectActive')
                ->name('group_deselect_active_blocks')
                ->middleware(['permission:blocks-add-delete|blocks-edit']);

            Route::get('/', 'BlocksController@index')
                ->name('blocks')
                ->middleware(['permission:blocks-add-delete|blocks-edit|blocks-view']);

            Route::get('add', 'BlocksController@getAdd')
                ->name('blocks_add')
                ->middleware(['permission:blocks-add-delete']);

            Route::post('add','BlocksController@postStore')
                ->name('add_new_block')
                ->middleware( ['permission:blocks-add-delete']);

            Route::get('edit/{id}', 'BlocksController@getEdit')
                ->name('edit_blocks')
                ->middleware(['permission:blocks-add-delete|blocks-edit|blocks-view']);

            Route::get('active/{id}','BlocksController@getActive')
                ->name('active_blocks')
                ->middleware(['permission:blocks-add-delete|blocks-edit']);

            Route::get('delete/{id}', 'BlocksController@getDelete')
                ->name('delete_blocks')
                ->middleware(['permission:blocks-add-delete']);

            Route::post('edit/{id}','BlocksController@postUpdate')
                ->name('update_blocks')
                ->middleware( ['permission:blocks-add-delete|blocks-edit|blocks-view']);

            Route::post('crop/{id}', 'BlocksController@postCropImage')
                ->name('blocks_crop')
                ->middleware(['permission:blocks-add-delete|blocks-edit']);

            Route::get('crop/view/{id}', 'BlocksController@getGetView')
                ->middleware( ['permission:blocks-add-delete|blocks-edit'])
                ->name('blocks_crop_view');

            Route::post('crop/view/{id}','BlocksController@postGetView')
                ->name('blocks_crop_view_post')
                ->middleware( ['permission:blocks-add-delete|blocks-edit']);
        });



        /**
         * group content tags routs
         */

        Route::group(['prefix' => 'tags'], function () {
            Route::post('action/delete', 'TagsController@postGroupDelete')
                ->name('group_delete_tags')
                ->middleware(['permission:tags-add-delete']);

            Route::post('action/active', 'TagsController@postGroupActive')
                ->name('group_active_tags')
                ->middleware(['permission:tags-add-delete|tags-edit']);

            Route::post('action/deselect', 'TagsController@postGroupDeselectActive')
                ->name('group_deselect_active_tags')
                ->middleware(['permission:tags-add-delete|tags-edit']);

            Route::get('/','TagsController@index')
                ->name('tags')
                ->middleware(['permission:tags-add-delete|tags-edit|tags-view']);

            Route::get('add', 'TagsController@getAdd')
                ->name('tags_add')
                ->middleware(['permission:tags-add-delete']);

            Route::post('add','TagsController@postStore' )->name('add_new_tag');

            Route::post('new','TagsController@postNew' )->name('add_tag_inline');

            Route::get('edit/{id}','TagsController@getEdit')
                ->name('edit_tags')
                ->middleware(['permission:tags-add-delete|tags-edit|tags-view']);

            Route::post('edit/{id}', 'TagsController@postUpdate')
                ->name('update_tags')
                ->middleware( ['permission:tags-add-delete|tags-edit']);

            Route::post('search','TagsController@postSearch')->name('search_tags');

            Route::post('keywords', 'TagsController@postKeywords')->name('search_keywords');

            Route::get('active/{id}','TagsController@getActive')
                ->name('active_tags')
                ->middleware(['permission:tags-add-delete|tags-edit']);

            Route::get('delete/{id}','TagsController@getDelete')
                ->name('delete_tags')
                ->middleware(['permission:tags-add-delete']);
        });


        /**
         * feedback routs
         */

        Route::group(['prefix' => 'feedback'], function () {
            Route::post('action/delete', 'TagsController@postGroupDelete')
                ->name('group_delete_feedback')
                ->middleware(['permission:feedback-add-delete']);

            Route::get('/','FeedbackController@index')
                ->name('feedback')
                ->middleware(['permission:feedback-add-delete|feedback-edit|feedback-view']);

            Route::get('edit/{id}','FeedbackController@getEdit')
                ->name('edit_feedback')
                ->middleware(['permission:feedback-add-delete|feedback-edit']);

            Route::post('edit/{id}','FeedbackController@postUpdate')
                ->name('update_feedback')
                ->middleware(['permission:feedback-add-delete|feedback-edit']);

            Route::get('delete/{id}','FeedbackController@getDelete')
                ->name('delete_feedback')
                ->middleware( ['permission:feedback-add-delete']);

            Route::get('{id}','FeedbackController@getStatus')
                ->name('status_feedback')
                ->middleware(['permission:feedback-add-delete|feedback-edit|feedback-view']);
        });


        /**
         * group comments routes
         */

        Route::group(['prefix' => 'comments'], function () {
            Route::get('status/{id}','CommentsController@getStatus')
                ->name('status_comments')
                ->middleware(['permission:comments-add-delete|comments-edit']);

            Route::post('add', 'CommentsController@postStore')
                ->name('comments_add')
                ->middleware(['permission:comments-add-delete']);

            Route::post('edit/{id}','CommentsController@postUpdate')
                ->name('update_comments')
                ->middleware(['permission:comments-add-delete']);

            Route::get('delete/{id}','CommentsController@getDelete')
                ->name('delete_comments')
                ->middleware(['permission:comments-add-delete']);

            Route::post('getform','CommentsController@postGetForm')
                ->name('comments_form_edit')
                ->middleware(['permission:comments-add-delete']);

            Route::get('getform','CommentsController@getForm')
                ->name('comments_form_add')
                ->middleware(['permission:comments-add-delete']);

            Route::get('{type}/{id?}','CommentsController@index')
                ->middleware(['permission:comments-add-delete|comments-view'])
                ->name('comments');
        });



        /**
         * group constants routes
         */

        Route::group(['prefix' => 'constants'], function () {
            Route::get('{group?}','ConstantsController@index')
                ->name('constants')
                ->middleware(['permission:constants-add-delete|constants-edit|constants-view'])
                ->where(['group'=>implode('|',array_keys(Config::get('admin.constants_group')))]);

            Route::get('{type}/add/{group?}','ConstantsController@getAdd')
                ->name('constants_add')
                ->middleware(['permission:constants-add-delete'])
                ->where(['group'=>implode('|',array_keys(Config::get('admin.constants_group')))]);

            Route::post('add','ConstantsController@postStore')
                ->name('add_new_constant')
                ->middleware(['permission:constants-add-delete']);

            Route::post('edit/{id}', 'ConstantsController@postUpdate')
                ->name('update_constants')
                ->middleware(['permission:constants-add-delete|constants-edit']);

            Route::get('active/{id}','ConstantsController@getActive')
                ->name('active_constants')
                ->middleware( ['permission:constants-add-delete|constants-edit']);

            Route::get('delete/{id}','ConstantsController@getDelete')
                ->name('delete_constants')
                ->middleware(['permission:constants-add-delete']);

            Route::post('edit/{id}/group', 'ConstantsController@postChangeGroup')
                ->name('change_group_constants')
                ->middleware(['permission:constants-add-delete|constants-edit']);
        });



        /**
         * group roles routs
         */

        Route::group(['prefix' => 'roles'], function () {
            Route::post('action/delete', 'RolesController@postGroupDelete')
                ->name('group_delete_roles')
                ->middleware(['permission:roles-add-delete']);

            Route::get('/','RolesController@index')
                ->name('roles')
                ->middleware(['permission:roles-add-delete|roles-edit|roles-view']);

            Route::get('add', 'RolesController@getAdd' )
                ->name('roles_add')
                ->middleware(['permission:roles-add-delete']);

            Route::post('add','RolesController@postStore')
                ->middleware(['permission:roles-add-delete'])
                ->name('add_new_role');

            Route::get('edit/{id}','RolesController@getEdit')
                ->middleware(['permission:roles-add-delete|roles-edit|roles-view'])
                ->name('edit_roles');

            Route::post('edit/{id}','RolesController@postUpdate')
                ->middleware(['permission:roles-add-delete|roles-edit'])
                ->name('update_roles');

            Route::get('delete/{id}', 'RolesController@getDelete')
                ->name('delete_roles')
                ->middleware( ['permission:roles-add-delete']);
        });



        /**
         * Route group permissions
         */

        Route::group(['prefix' => 'permissions'], function () {
            Route::post('action/delete', 'PermissionsController@postGroupDelete')
                ->name('group_delete_permissions')
                ->middleware(['permission:permissions-add-delete']);

            Route::get('/','PermissionsController@index')
                ->name('permissions')
                ->middleware(['permission:roles-add-delete|roles-edit|roles-view']);

            Route::get('add','PermissionsController@getAdd')
                ->name('permissions_add')
                ->middleware( ['permission:permissions-add-delete']);

            Route::post('add','PermissionsController@postStore')
                ->name('add_new_permission')
                ->middleware(['permission:permissions-add-delete']);

            Route::get('edit/{id}','PermissionsController@getEdit')
                ->name('edit_permissions')
                ->middleware(['permission:permissions-add-delete|permissions-edit|permissions-view']);

            Route::post('edit/{id}', 'PermissionsController@postUpdate')
                ->name('update_permissions')
                ->middleware( ['permission:permissions-add-delete|permissions-edit']);

            Route::get('delete/{id}','PermissionsController@getDelete')
                ->name('delete_permissions')
                ->middleware( ['permission:permissions-add-delete']);
        });



        /**
         * group user routs
         */

        Route::group(['prefix' => 'users'], function () {
            Route::post('action/delete', 'UsersController@postGroupDelete')
                ->name('group_delete_users')
                ->middleware(['permission:users-add-delete']);

            Route::get('/','UsersController@index')
                ->name('users')
                ->middleware(['permission:users-add-delete|users-edit|users-view']);

            Route::get('add', 'UsersController@getAdd')
                ->middleware(['permission:users-add-delete'])
                ->name('users_add');

            Route::post('add', 'UsersController@postStore')
                ->name('add_new_user')
                ->middleware(['permission:users-add-delete']);

            Route::get('edit/{id}','UsersController@getEdit')
                ->name('edit_users')
                ->middleware(['permission:users-add-delete|users-edit|users-view']);

            Route::get('password/{id}','UsersController@getEditPassword')
                ->name('edit_users_passwords')
                ->middleware( ['permission:users-add-delete|users-edit']);

            Route::post('edit/{id}', 'UsersController@postUpdate')
                ->name('update_users')
                ->middleware(['permission:users-add-delete|users-edit']);

            Route::post('password/{id}','UsersController@postNewPassword')
                ->name('change_users_password')
                ->middleware(['permission:users-add-delete|users-edit']);

            Route::get('delete/{id}','UsersController@getDelete')
                ->name('delete_users')
                ->middleware(['permission:users-add-delete']);

            Route::post('avatar/{id}','UsersController@postUpdateImage')
                ->middleware(['permission:users-add-delete|users-edit'])
                ->name('update_users_avatar');

            Route::get('crop/view/{id}','UsersController@getGetView')
                ->name('users_crop_view')
                ->middleware(['permission:users-add-delete|users-edit']);

            Route::post('crop/{id}','UsersController@postCropImage')
                ->name('users_crop')
                ->middleware(['permission:users-add-delete|users-edit']);

            Route::get('{id}/timeline','UsersController@getLogsUser')
                ->name('users_activity')
                ->middleware(['permission:users-add-delete|users-edit']);
        });



        /**
         * group site users routs
         */

        Route::group(['prefix' => 'siteusers'], function () {
            Route::post('action/delete', 'SiteUsersController@postGroupDelete')
                ->name('group_delete_siteusers')
                ->middleware(['permission:siteusers-add-delete']);

            Route::get('/','SiteUsersController@index')
                ->name('siteusers')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit|siteusers-view']);

            Route::get('add', 'SiteUsersController@getAdd')
                ->middleware(['permission:siteusers-add-delete'])
                ->name('siteusers_add');

            Route::post('add', 'SiteUsersController@postStore')
                ->name('add_new_siteusers')
                ->middleware(['permission:siteusers-add-delete']);

            Route::get('edit/{id}','SiteUsersController@getEdit')
                ->name('edit_siteusers')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit|siteusers-view']);

            Route::get('password/{id}','SiteUsersController@getEditPassword')
                ->name('edit_siteusers_passwords')
                ->middleware( ['permission:siteusers-add-delete|siteusers-edit']);

            Route::post('edit/{id}', 'SiteUsersController@postUpdate')
                ->name('update_siteusers')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit']);

            Route::post('password/{id}','SiteUsersController@postNewPassword')
                ->name('change_siteusers_password')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit']);

            Route::get('delete/{id}','SiteUsersController@getDelete')
                ->name('delete_siteusers')
                ->middleware(['permission:siteusers-add-delete']);

            Route::post('avatar/{id}','SiteUsersController@postUpdateImage')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit'])
                ->name('siteusers_users_avatar');

            Route::get('crop/view/{id}','SiteUsersController@getGetView')
                ->name('siteusers_crop_view')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit']);

            Route::post('crop/{id}','SiteUsersController@postCropImage')
                ->name('siteusers_crop')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit']);

            Route::get('{id}/timeline','SiteUsersController@getLogsUser')
                ->name('siteusers_activity')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit']);

            Route::get('socials/{id}','SiteUsersController@getSocials')
                ->name('siteusers_socials')
                ->middleware(['permission:siteusers-add-delete|siteusers-edit|siteusers-view']);
        });




        /**
         * group basket routs
         */

        Route::group(['prefix' => 'basket'], function () {
            Route::post('action/delete', 'BasketController@postGroupDelete')
                ->name('group_delete_basket')
                ->middleware(['permission:basket-add-delete']);

            Route::post('action/restore', 'BasketController@postGroupRestore')
                ->name('group_recovery_basket')
                ->middleware(['permission:basket-add-delete']);

            Route::get('/','BasketController@index')
                ->name('basket')
                ->middleware(['permission:basket-add-delete|basket-edit|basket-view']);

            Route::get('delete/{id}', 'BasketController@getDelete' )
                ->name('delete_basket')
                ->middleware(['permission:basket-add-delete']);

            Route::get('restore/{id}','BasketController@getRecovery')
                ->name('basket_restore')
                ->middleware(['permission:basket-add-delete|basket-edit']);

            Route::post('delete/all','BasketController@postDeleteAll')
                ->name('delete_basket_all')
                ->middleware(['permission:basket-add-delete']);

            Route::post('restore/all', 'BasketController@postRecoveryAll')
                ->name('basket_restore_all')
                ->middleware(['permission:basket-add-delete|basket-edit']);
        });


        /**
         * Sliders routs
         */

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/','SlidersController@index')
                ->name('sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit|sliders-view']);

            Route::get('add','SlidersController@getAdd')
                ->name('sliders_add')
                ->middleware(['permission:sliders-add-delete']);

            Route::post('add','SlidersController@postStore')
                ->name('add_new_slide')
                ->middleware(['permission:sliders-add-delete']);

            Route::get('edit/{id}','SlidersController@getEdit')
                ->name('edit_sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit|sliders-view']);

            Route::post('edit/{id}','SlidersController@postUpdate')
                ->name('update_sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::get('delete/{id}','SlidersController@getDelete')
                ->name('delete_sliders')
                ->middleware(['permission:sliders-add-delete']);

            Route::get('delete/unit/{id}','SlidersController@getDeleteUnit')
                ->name('delete_sliders_unit')
                ->middleware(['permission:sliders-add-delete']);

            Route::get('active/{id}','SlidersController@getActive')
                ->name('active_sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::get('active/unit/{id}','SlidersController@getActiveUnit')
                ->name('active_sliders_unit')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::get('add/unit/{id}','SlidersController@getAddUnit')
                ->name('sliders_add_unit')
                ->middleware(['permission:sliders-add-delete']);

            Route::post('add/unit/{id}','SlidersController@postStoreUnit')
                ->name('add_new_unit')
                ->middleware(['permission:sliders-add-delete']);

            Route::get('edit/unit/{id}', 'SlidersController@getEditUnit')
                ->name('edit_sliders_unit')
                ->middleware(['permission:sliders-add-delete|sliders-edit|sliders-view']);

            Route::post('edit/unit/{id}','SlidersController@postUpdateUnit')
                ->name('update_sliders_unit')
                ->middleware(['permission:sliders-add-delete|sliders-edit|sliders-view']);

            Route::post('crop/{id}','SlidersController@postCropImage')
                ->name('sliders_crop')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::get('crop/view/{id}','SlidersController@getGetView')
                ->name('sliders_crop_view')
                ->middleware( ['permission:sliders-add-delete|sliders-edit']);

            Route::post('crop/view/{id}','SlidersController@postGetView')
                ->name('sliders_crop_view_post')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::post('action/delete', 'SlidersController@postGroupDelete')
                ->name('group_delete_sliders')
                ->middleware(['permission:sliders-add-delete']);

            Route::post('action/active', 'SlidersController@postGroupActive')
                ->name('group_active_sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::post('action/deselect', 'SlidersController@postGroupDeselectActive')
                ->name('group_deselect_active_sliders')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);

            Route::post('units/position', 'SlidersController@postUnitsPosition')
                ->name('sliders_units_position')
                ->middleware(['permission:sliders-add-delete|sliders-edit']);
        });



    });
});
