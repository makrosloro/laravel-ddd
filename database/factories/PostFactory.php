<?php

namespace Database\Factories;

use Domain\Blog\Models\Category;
use Domain\Blog\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
