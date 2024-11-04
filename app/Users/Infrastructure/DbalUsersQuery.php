<?php

namespace App\Users\Infrastructure;

use App\Framework\Http\Resources\UserResource;
use App\Framework\Models\User;
use App\Users\Application\UsersQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DbalUsersQuery implements UsersQuery
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function execute(): AnonymousResourceCollection
    {
        $users = $this->user->all();
        return UserResource::collection($users);
    }
}
