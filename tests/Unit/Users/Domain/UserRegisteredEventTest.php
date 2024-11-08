<?php

namespace Tests\Unit\Users\Domain;

use App\Users\Domain\User;
use App\Users\Domain\UserRegistered;
use Illuminate\Broadcasting\PrivateChannel;
use Tests\TestCase;

class UserRegisteredEventTest extends TestCase
{
    public function test_user_registered_event_holds_correct_data(): void
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $password = 'hashed_password';
        $user = User::submit($name, $email, $password);

        $event = new UserRegistered($user);

        $this->assertEquals($name, $event->user->getName());
        $this->assertEquals($email, $event->user->getEmail());
        $this->assertEquals($password, $event->user->getPassword());
    }

    public function test_user_registered_event_broadcasts_on_correct_channel(): void
    {
        $user = User::submit('John Doe', 'john@example.com', 'hashed_password');
        $event = new UserRegistered($user);

        $this->assertEquals([new PrivateChannel('channel-name')], $event->broadcastOn());
    }
}
