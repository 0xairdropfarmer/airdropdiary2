<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'project_create',
            ],
            [
                'id'    => 20,
                'title' => 'project_edit',
            ],
            [
                'id'    => 21,
                'title' => 'project_show',
            ],
            [
                'id'    => 22,
                'title' => 'project_delete',
            ],
            [
                'id'    => 23,
                'title' => 'project_access',
            ],
            [
                'id'    => 24,
                'title' => 'category_create',
            ],
            [
                'id'    => 25,
                'title' => 'category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'category_show',
            ],
            [
                'id'    => 27,
                'title' => 'category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'category_access',
            ],
            [
                'id'    => 29,
                'title' => 'tag_create',
            ],
            [
                'id'    => 30,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 31,
                'title' => 'tag_show',
            ],
            [
                'id'    => 32,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 33,
                'title' => 'tag_access',
            ],
            [
                'id'    => 34,
                'title' => 'task_create',
            ],
            [
                'id'    => 35,
                'title' => 'task_edit',
            ],
            [
                'id'    => 36,
                'title' => 'task_show',
            ],
            [
                'id'    => 37,
                'title' => 'task_delete',
            ],
            [
                'id'    => 38,
                'title' => 'task_access',
            ],
            [
                'id'    => 39,
                'title' => 'activity_create',
            ],
            [
                'id'    => 40,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 41,
                'title' => 'activity_show',
            ],
            [
                'id'    => 42,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 43,
                'title' => 'activity_access',
            ],
            [
                'id'    => 44,
                'title' => 'todo_create',
            ],
            [
                'id'    => 45,
                'title' => 'todo_edit',
            ],
            [
                'id'    => 46,
                'title' => 'todo_show',
            ],
            [
                'id'    => 47,
                'title' => 'todo_delete',
            ],
            [
                'id'    => 48,
                'title' => 'todo_access',
            ],
            [
                'id'    => 49,
                'title' => 'strategy_create',
            ],
            [
                'id'    => 50,
                'title' => 'strategy_edit',
            ],
            [
                'id'    => 51,
                'title' => 'strategy_show',
            ],
            [
                'id'    => 52,
                'title' => 'strategy_delete',
            ],
            [
                'id'    => 53,
                'title' => 'strategy_access',
            ],
            [
                'id'    => 54,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
