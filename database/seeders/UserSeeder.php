<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::pluck('id', 'name')->toArray();
        $roleViewerId = $roles[Role::VIEWER];
        $roleEditorId = $roles[Role::EDITOR];

        // Create 1 admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        $admin->roles()->sync($roles);

        // Create 2 editor
        User::factory(2)->create()->each(function ($user) use ($roleEditorId) {
            $user->roles()->sync([$roleEditorId]);
        });

        // Create 10 viewer
        User::factory(10)->create()->each(function ($user) use ($roleViewerId) {
            $user->roles()->sync([$roleViewerId]);
        });

    }
}
