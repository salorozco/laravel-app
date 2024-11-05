<?php

namespace App\Users\Presentation;

use App\Users\Application\SubmitUserCommand;

class UserForm
{
    private string $name;

    private string $email;

    private string $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function toCommand(): SubmitUserCommand
    {
        return new SubmitUserCommand(
            $this->name,
            $this->email,
            $this->password
        );
    }
}
