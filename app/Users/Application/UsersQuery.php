<?php

namespace App\Users\Application;

use Illuminate\Database\Eloquent\Collection;

interface UsersQuery
{
    public function execute(): Collection;
}
