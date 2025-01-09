<?php

namespace App\Posts\Application;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
interface PostsQuery
{
    public function execute(int $userId): AnonymousResourceCollection;
}
