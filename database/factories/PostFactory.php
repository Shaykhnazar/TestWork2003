<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $adminOrEditor = User::whereHas('roles', function ($query) {
            $query->whereIn('name', [Role::ADMIN, Role::EDITOR]);
        })->first();

        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'created_by' => $adminOrEditor->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
