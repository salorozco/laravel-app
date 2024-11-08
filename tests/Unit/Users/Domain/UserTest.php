<?php

namespace Tests\Unit\Users\Domain;

use App\Users\Domain\User;
use Ramsey\Uuid\UuidInterface;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_can_be_created()
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $password = 'hashed_password';

        $user =  User::submit($name, $email, $password);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
        $this->assertInstanceOf(UuidInterface::class, $user->getUuid());

    }

}
