<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve users and create posts for each
        $users = User::whereIn('email', ['sal@example.com', 'kobe@example.com'])->get();

        foreach ($users as $user) {
            $user->posts()->saveMany(Post::factory(5)->make());
        }
    }
}
