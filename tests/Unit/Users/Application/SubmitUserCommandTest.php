<?php

namespace Tests\Unit\Users\Application;

use App\Users\Application\SubmitUserCommand;
use Tests\TestCase;

class SubmitUserCommandTest extends TestCase
{
    public function test_submit_user_command_properties()
    {
        //arrange
        $name = 'John Doe';
        $email = 'john@doe.com';
        $password = 'password';

        //act
        $submitUserCommand = new SubmitUserCommand($name, $email, $password);

        //assert
        $this->assertSame($name, $submitUserCommand->getName());
        $this->assertSame($email, $submitUserCommand->getEmail());
        $this->assertSame($password, $submitUserCommand->getPassword());
    }
}
