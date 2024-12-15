<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'commentable_id' => $this->faker->numberBetween(1, 50),
            'commentable_type' => $this->faker->randomElement([
                Post::class,
            ]),
            'parent_id' => null,
            'likes_count' => $this->faker->numberBetween(0, 100), // Random number of likes
        ];
    }

    /**
     * Define a state for nested comments (replies).
     */
    public function reply($parentId): Factory|CommentFactory
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId,
        ]);
    }
}
