<?php

namespace App\Posts\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\PostResource;
use App\Models\Post;
use App\Posts\Application\PostDto;
use App\Posts\Application\PostsQuery;
use App\Users\Application\UserDto;
use DateTime;
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
        $paginatedPosts = Post::where('user_id', $userId)
            ->with('user')
            ->paginate(10);

        if ($paginatedPosts->isEmpty()) {
            throw new UserNotFoundException();
        }

        $user = $paginatedPosts->first()->user;
        $userDTO =  new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->created_at
        );

        $postDTOS = $paginatedPosts->map(function (Post $post) use ($userDTO) {
            return new PostDTO(
                $post->id,
                $post->title,
                $post->body,
                $post->user_id,
                $post->slug,
                $post->status,
                $post->featured_image,
                $post->views,
                $post->published_at ? new DateTime($post->published_at) : null,
                $post->created_at,
                $userDTO
            );
        });

        $paginatedPosts->setCollection($postDTOS);

        return PostResource::collection($paginatedPosts);
    }
}
