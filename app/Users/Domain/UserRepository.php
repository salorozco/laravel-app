<?php

namespace App\Users\Domain;

use App\Framework\Http\Resources\UserResource;

interface UserRepository
{
    public function add(User $user):void;

    public function findUserById(int $id): UserResource;
}
