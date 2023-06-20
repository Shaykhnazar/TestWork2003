<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::pluck('id', 'name');
        $adminRoleId = $roles->get(Role::ADMIN);
        $editorRoleId = $roles->get(Role::EDITOR);
        $viewerRoleId = $roles->get(Role::VIEWER);

        $toCreate = [
            [
                'id' => 1,
                'name' => 'Add Role',
                'description' => 'Only Admin user can add a new role',
                'roles_to_sync' => [$adminRoleId]
            ],
            [
                'id' => 2,
                'name' => 'Edit Role',
                'description' => 'Only Admin user can edit existing role',
                'roles_to_sync' => [$adminRoleId]
            ],
            [
                'id' => 3,
                'name' => 'Delete Role',
                'description' => 'Only Admin user can delete existing role',
                'roles_to_sync' => [$adminRoleId]
            ],
            [
                'id' => 4,
                'name' => 'Show Post',
                'description' => 'Viewer can show posts list or one post',
                'roles_to_sync' => [$adminRoleId, $editorRoleId, $viewerRoleId]
            ],
            [
                'id' => 5,
                'name' => 'Create Post',
                'description' => 'Post editor can create a new post',
                'roles_to_sync' => [$adminRoleId, $editorRoleId]
            ],
            [
                'id' => 6,
                'name' => 'Edit Post',
                'description' => 'Post editor can edit post',
                'roles_to_sync' => [$adminRoleId, $editorRoleId]
            ],
            [
                'id' => 7,
                'name' => 'Delete Post',
                'description' => 'Post editor can delete post',
                'roles_to_sync' => [$adminRoleId, $editorRoleId]
            ],
        ];
        foreach ($toCreate as $data) {
            $permission = Permission::updateOrCreate(
                ['id' => $data['id']], \Arr::except($data, 'roles_to_sync')
            );
            $permission->roles()->sync($data['roles_to_sync']);
        }
    }
}
