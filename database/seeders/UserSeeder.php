<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roleIds = Role::pluck('id', 'name')->toArray();
        $roleViewerId = $roleIds[Role::VIEWER];
        $roleEditorId = $roleIds[Role::EDITOR];

        $testUsers = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('password'),
                'role_ids_to_sync' => $roleIds
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@test.com',
                'password' => \Hash::make('password'),
                'role_ids_to_sync' => [$roleEditorId, $roleViewerId]
            ],
            [
                'name' => 'Viewer',
                'email' => 'viewer@test.com',
                'password' => \Hash::make('password'),
                'role_ids_to_sync' => [$roleViewerId]
            ],
        ];

        foreach ($testUsers as $data) {
            $user = User::query()->firstOrCreate(
                ['email' => $data['email']], \Arr::except($data, 'role_ids_to_sync')
            );
            $user->syncRoles($data['role_ids_to_sync']);
        }

        // Create 10 random viewers
        User::factory(10)->create()->each(function ($user) use ($roleViewerId) {
            $user->roles()->sync([$roleViewerId]);
        });
    }
}
