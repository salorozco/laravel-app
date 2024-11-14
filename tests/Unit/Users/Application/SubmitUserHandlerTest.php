<?php

namespace Tests\Unit\Users\Application;

use App\Users\Application\SubmitUserCommand;
use App\Users\Application\SubmitUserHandler;
use App\Users\Domain\User;
use App\Users\Domain\UserRegistered;
use App\Users\Domain\UserRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Assert;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class SubmitUserHandlerTest extends TestCase
{
    private $userRepository;
    private $submitUserHandler;
    private $submitUserCommand;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->submitUserCommand = $this->createMock(SubmitUserCommand::class);

        $this->submitUserHandler = new SubmitUserHandler($this->userRepository);
    }

    public function test_handle_creates_user_and_adds_to_repository()
    {
        // Fake the events
        Event::fake();

        //arrange
        $name = 'John Doe';
        $email = 'john@doe.com';
        $password = 'password';

        $this->submitUserCommand->method('getName')->willReturn($name);
        $this->submitUserCommand->method('getEmail')->willReturn($email);
        $this->submitUserCommand->method('getPassword')->willReturn($password);

        $user = User::submit($name, $email, $password);

        $this->userRepository->expects($this->once())
            ->method('add')
            ->with($this->callback(function (User $user) use ($name, $email, $password) {
                Assert::assertSame($name, $user->getName());
                Assert::assertSame($email, $user->getEmail());
                Assert::assertSame($password, $user->getPassword());
                Assert::assertNotNull($user->getUuid());
                return true;
            }));

        // Act
        $this->submitUserHandler->handle($this->submitUserCommand);

    }

}
