<?php

namespace Tests\Unit\Users\Application;

use App\Users\Application\UserDto;
use Tests\TestCase;
use DateTime;

class UserDtoTest extends TestCase
{
    public function test_it_can_be_created()
    {
        //arrange
        $id = 'user-123';
        $name = 'John Doe';
        $email = 'john@doe.com';
        $createdAt = new DateTime('2024-11-13 10:00:00');

        //act
        $userDto = new UserDto($id, $name, $email, $createdAt);

        //assert
        $this->assertEquals($id, $userDto->getId());
        $this->assertEquals($name, $userDto->getName());
        $this->assertEquals($email, $userDto->getEmail());
        $this->assertEquals('2024-11-13 10:00:00', $userDto->getCreatedAt());
    }
}
