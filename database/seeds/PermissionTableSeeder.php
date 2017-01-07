<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'name' => 'index-view',
                'display_name' => 'View main page',
                'description' => 'The user has access to view the main page'
            ],
            [
                'name' => 'blocks-add-delete',
                'display_name' => 'Add or delete text block',
                'description' => 'The User has access to add or delete text blocks'
            ],
            [
                'name' => 'blocks-view',
                'display_name' => 'Viewing of text blocks',
                'description' => 'The user has access to view the text blocks'
            ],
            [
                'name' => 'blocks-edit',
                'display_name' => 'Editing of text blocks',
                'description' => 'The user has access to edit the text blocks'
            ],

            [
                'name' => 'comments-add-delete',
                'display_name' => 'Send answer or delete comments',
                'description' => 'The User has access to add or delete comments'
            ],
            [
                'name' => 'comments-edit',
                'display_name' => 'Edit status comments',
                'description' => 'The User has access to edit status comments'
            ],
            [
                'name' => 'comments-view',
                'display_name' => 'Viewing of comments',
                'description' => 'The user has access to view comments'
            ],

            [
                'name' => 'constants-add-delete',
                'display_name' => 'Add or delete constants',
                'description' => 'The User has access to add or delete constants'
            ],
            [
                'name' => 'constants-view',
                'display_name' => 'Viewing of constants',
                'description' => 'The user has access to view constants'
            ],
            [
                'name' => 'constants-edit',
                'display_name' => 'Editing of constants',
                'description' => 'The user has access to edit constants'
            ],

            [
                'name' => 'content-add-delete',
                'display_name' => 'Add or delete contents',
                'description' => 'The User has access to add or delete contents'
            ],
            [
                'name' => 'content-view',
                'display_name' => 'Viewing of contents',
                'description' => 'The user has access to view contents'
            ],
            [
                'name' => 'content-edit',
                'display_name' => 'Editing of contents',
                'description' => 'The user has access to edit contents'
            ],

            [
                'name' => 'feedback-add-delete',
                'display_name' => 'Send answer or delete feedback messages',
                'description' => 'The User has access to send answer or delete feedback messages'
            ],
            [
                'name' => 'feedback-view',
                'display_name' => 'Viewing of feedback messages',
                'description' => 'The user has access to view feedback messages'
            ],

            [
                'name' => 'gallery-add-delete',
                'display_name' => 'Add or delete gallery folders and units',
                'description' => 'The User has access to add or delete gallery folders and units'
            ],
            [
                'name' => 'gallery-view',
                'display_name' => 'Viewing of gallery folders and units',
                'description' => 'The user has access to view gallery folders and units'
            ],
            [
                'name' => 'gallery-edit',
                'display_name' => 'Editing of gallery folders and units',
                'description' => 'The user has access to edit gallery folders and units'
            ],

            [
                'name' => 'permissions-add-delete',
                'display_name' => 'Add or delete permissions',
                'description' => 'The User has access to add or delete permissions'
            ],
            [
                'name' => 'permissions-view',
                'display_name' => 'Viewing of permissions',
                'description' => 'The user has access to view permissions'
            ],
            [
                'name' => 'permissions-edit',
                'display_name' => 'Editing of permissions',
                'description' => 'The user has access to edit permissions'
            ],

            [
                'name' => 'roles-add-delete',
                'display_name' => 'Add or delete roles',
                'description' => 'The User has access to add or delete roles'
            ],
            [
                'name' => 'roles-view',
                'display_name' => 'Viewing of roles',
                'description' => 'The user has access to view roles'
            ],
            [
                'name' => 'roles-edit',
                'display_name' => 'Editing of roles',
                'description' => 'The user has access to edit roles'
            ],

            [
                'name' => 'structure-add-delete',
                'display_name' => 'Add or delete structure items',
                'description' => 'The User has access to add or delete structure items'
            ],
            [
                'name' => 'structure-view',
                'display_name' => 'Viewing of structure items',
                'description' => 'The user has access to view structure items'
            ],
            [
                'name' => 'structure-edit',
                'display_name' => 'Editing of structure items',
                'description' => 'The user has access to edit structure items'
            ],

            [
                'name' => 'tags-add-delete',
                'display_name' => 'Add or delete content tags',
                'description' => 'The User has access to add or delete content tags'
            ],
            [
                'name' => 'tags-view',
                'display_name' => 'Viewing of content tags',
                'description' => 'The user has access to view content tags'
            ],
            [
                'name' => 'tags-edit',
                'display_name' => 'Editing of content tags',
                'description' => 'The user has access to edit content tags'
            ],

            [
                'name' => 'users-add-delete',
                'display_name' => 'Add or delete admin panel users',
                'description' => 'The User has access to add or delete admin panel users'
            ],
            [
                'name' => 'users-view',
                'display_name' => 'Viewing of admin panel users',
                'description' => 'The user has access to view admin panel users'
            ],
            [
                'name' => 'users-edit',
                'display_name' => 'Editing of admin panel users',
                'description' => 'The user has access to edit admin panel users'
            ],

            [
                'name' => 'basket-add-delete',
                'display_name' => 'Add or delete basket items',
                'description' => 'The User has access to add or delete basket items'
            ],
            [
                'name' => 'basket-view',
                'display_name' => 'Viewing of basket items',
                'description' => 'The user has access to view basket items'
            ],
            [
                'name' => 'basket-edit',
                'display_name' => 'Editing of basket items',
                'description' => 'The user has access to edit basket items'
            ],

        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }

        $roles = [
            [
                'name' => 'programmer',
                'display_name' => 'Programmer',
                'description' => 'User has all permissions for this admin applications'
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'User has admin permissions'
            ],
            [
                'name' => 'content-manager',
                'display_name' => 'Content manager',
                'description' => 'Content manager'
            ],
            [
                'name' => 'ban',
                'display_name' => 'Ban',
                'description' => 'Denied access for all system pages'
            ],

        ];

        foreach ($roles as $key => $value) {
            \App\Role::create($value);
        }

        $programmer_role = \App\Role::where('name','programmer')->first();
        $permission = Permission::all();
        foreach($permission as $value){
            $programmer_role->attachPermission($value->id);
        }

        $ban_role = \App\Role::where('name','ban')->first();
        $permission = Permission::where('name','index-view')->first();
        $ban_role->attachPermission($permission->id);

        $admin_role = \App\Role::where('name','admin')->first();
        $permission = Permission::where('name','index-view')->first();
        $admin_role->attachPermission($permission->id);

        $content_manager_role = \App\Role::where('name','content-manager')->first();
        $permission = Permission::where('name','index-view')->first();
        $content_manager_role->attachPermission($permission->id);

        $admin_user = \App\User::find(1);
        $admin_user->attachRole($programmer_role->id);

    }
}
