<?php

namespace App\Users\Presentation;

use App\Framework\Http\Requests\UserRequest;

class UserFormFactory
{
    public function createFromRequest(UserRequest $request): UserForm
    {
        return new UserForm(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
        );
    }
}
