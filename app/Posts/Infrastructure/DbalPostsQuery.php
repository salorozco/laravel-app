<?php

namespace App\Posts\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\PostResource;
use App\Models\Post;
use App\Posts\Application\PostDto;
use App\Posts\Application\PostsQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DbalPostsQuery implements PostsQuery
{

    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function execute(int $userId): AnonymousResourceCollection
    {
        $paginatedPosts = Post::where('user_id', $userId)->paginate(10);

        if ($paginatedPosts->isEmpty()) {
            throw new UserNotFoundException();
        }


        $postDTOS = $paginatedPosts->map(function (Post $post) {
            return new PostDTO(
                $post->id,
                $post->title,
                $post->body,
                $post->user_id,
                $post->slug,
                $post->featured_image,
                $post->views,
                $post->published_at,
                $post->created_at
            );
        });

        $paginatedPosts->setCollection($postDTOS);

        return PostResource::collection($paginatedPosts);
    }
}
