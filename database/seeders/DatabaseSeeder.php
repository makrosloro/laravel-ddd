<?php

namespace Database\Seeders;

use Domain\Shared\Models\User;
use Domain\Blog\Models\Category;
use Domain\Blog\Models\Post;
use Domain\Blog\Models\Tag;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        User::factory()->count(10)->create();
        Category::factory()->count(5)->create();
        Tag::factory()->count(20)->create();
        $posts = Post::factory()->count(200)->create();
        $posts->each(function (Post $post) {
            $post->tags()->saveMany(Tag::all()->random(3));
        });
    }
}
