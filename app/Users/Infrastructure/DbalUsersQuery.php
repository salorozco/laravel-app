<?php

namespace App\Users\Infrastructure;

use App\Models\User;
use App\Users\Application\UsersQuery;
use Illuminate\Database\Eloquent\Collection;

class DbalUsersQuery implements UsersQuery
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function execute(): Collection
    {
        return $this->user::all();
    }
}
