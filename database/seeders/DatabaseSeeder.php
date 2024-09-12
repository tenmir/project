<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\ReactionsType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $posts = Post::factory()
            ->count(10)
            ->for($user)
            ->create();

        $comments = Comment::factory()
            ->count(5)
            ->create();

         $reactionTypes = ReactionsType::factory()
         ->count(2)
         ->create();
    }



}
