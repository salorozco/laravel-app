<?php

namespace App\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Models\User;
use App\Users\Application\UserDto;
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
        $paginatedUsers = $this->user->paginate(10);

        if ($paginatedUsers->isEmpty()) {
            throw new UserNotFoundException();
        }

        $userDTOS = $paginatedUsers->getCollection()->map(function ($user) {
            return new UserDto(
                $user->id,
                $user->name,
                $user->email,
                $user->created_at
            );
        });

        $paginatedUsers->setCollection($userDTOS);

        return UserResource::collection($paginatedUsers);
    }
}
