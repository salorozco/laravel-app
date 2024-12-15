<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed comments for posts
        Post::all()->each(function ($post) {
            // Create top-level comments for each post
            $comments = Comment::factory()->count(5)->create([
                'commentable_id' => $post->id,
                'commentable_type' => Post::class,
            ]);

            // Create replies for each top-level comment
            $comments->each(function ($comment) {
                Comment::factory()
                    ->count(3) // Number of replies per comment
                    ->reply($comment->id)
                    ->create([
                        'commentable_id' => $comment->commentable_id,
                        'commentable_type' => $comment->commentable_type,
                    ]);
            });
        });
    }
}
