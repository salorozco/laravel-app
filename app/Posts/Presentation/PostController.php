<?php

namespace App\Posts\Presentation;

use App\Framework\Http\Requests\PostRequest;
use App\Framework\Http\Resources\PostResource;
use App\Models\Post;
use App\Posts\Application\PostsQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController
{
    private PostsQuery $postsQuery;

    /**
     * @param PostsQuery $postsQuery
     */
    public function __construct(PostsQuery $postsQuery)
    {
        $this->postsQuery = $postsQuery;
    }

    public function index()
    {
        return Post::all();
    }

    public function show(int $userId, int $postId): PostResource
    {
        $post = Post::where('id', $postId)
            ->where('user_id', $userId)
            ->with('user')
            ->first();

        return new PostResource($post);
    }

    public function create(PostRequest $request): PostRequest
    {
        return new PostRequest($request);
    }

    public function getPostsByUser(int $userId): AnonymousResourceCollection
    {
        return $this->postsQuery->execute($userId);
    }
}
