<?php

namespace App\Users\Application;

use DateTime;

class UserDto
{
    private string $id;

    private string $name;

    private string $email;

    private DateTime $created_at;

    public function __construct(
        string $id,
        string $name,
        string $email,
        DateTime $created_at
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->created_at = $created_at;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
