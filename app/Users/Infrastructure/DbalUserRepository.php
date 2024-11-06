<?php

namespace App\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Models\User as UserModel;
use App\Users\Application\UserDto;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;

class DbalUserRepository implements UserRepository
{
    private UserModel $userModel;
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function add(User $user):void
    {
        $userModel = new UserModel;
        $userModel->uuid = $user->getUuid()->toString();
        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();
        $userModel->password = $user->getPassword();
        $userModel->save();
    }

    /**
     * @throws UserNotFoundException
     */
    public function findUserById(int $id): UserResource
    {
        $user = $this->userModel::find($id);

        if (! $user) {
            throw new UserNotFoundException();
        }

        $userDto = new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->created_at
        );

        return new UserResource($userDto);
    }
}
