<?php

namespace App\Users\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $uuid;
    private string $name;

    private string $email;

    private string $password;

    private function __construct(
        UuidInterface $uuid,
        string $name,
        string $email,
        string $password
    ) {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function submit(
        string $name,
        string $email,
        string $password
    ): User {
        return new User(
            Uuid::uuid4(),
            $name,
            $email,
            $password
        );
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
