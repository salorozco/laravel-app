<?php

namespace App\Users\Application;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UsersQuery
{
    public function execute(): AnonymousResourceCollection;
}
