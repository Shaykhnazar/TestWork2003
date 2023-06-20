<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $toCreate = [
            [
                'id' => 1,
                'name' => Role::ADMIN,
                'description' => 'Администратор',
            ],
            [
                'id' => 2,
                'name' => Role::EDITOR,
                'description' => 'Редактор',
            ],
            [
                'id' => 3,
                'name' => Role::VIEWER,
                'description' => 'Зритель',
            ],
        ];
        foreach ($toCreate as $data) {
            Role::updateOrCreate(['id' => $data['id']], $data);
        }
    }
}
