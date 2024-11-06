<?php

namespace Tests\Unit\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Models\User as UserModel;
use App\Users\Domain\User;
use App\Users\Infrastructure\DbalUserRepository;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
class DbalUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_create_a_user(): void
    {
        // Create a mock User domain object
        $user = Mockery::mock(User::class);
        $user->shouldReceive('getUuid->toString')->andReturn('123e4567-e89b-12d3-a456-426614174000');
        $user->shouldReceive('getName')->andReturn('John Doe');
        $user->shouldReceive('getEmail')->andReturn('john@example.com');
        $user->shouldReceive('getPassword')->andReturn('hashed_password');

        // Create a mock for UserModel and set expectations for attribute assignments
        $userModelMock = Mockery::mock(UserModel::class);
        $userModelMock->shouldReceive('setAttribute')->with('uuid', '123e4567-e89b-12d3-a456-426614174000')->once();
        $userModelMock->shouldReceive('setAttribute')->with('name', 'John Doe')->once();
        $userModelMock->shouldReceive('setAttribute')->with('email', 'john@example.com')->once();
        $userModelMock->shouldReceive('setAttribute')->with('password', 'hashed_password')->once();

        // Expect the save method to be called once
        $userModelMock->shouldReceive('save')->once();

        // Inject the mock into the repository
        $repository = new DbalUserRepository($userModelMock);

        // Call the add method
        $repository->add($user);
    }

    /**
     * @throws UserNotFoundException
     */
    public function test_it_should_return_a_user(): void
    {
        $userMock = Mockery::mock(UserModel::class);
        $userMock->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn((object)[
                'id' => '1',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'created_at' => now()
            ]);

        $dbalUsersQuery = new DbalUserRepository($userMock);
        $result = $dbalUsersQuery->findUserById(1);

        $this->assertInstanceOf(UserResource::class, $result);
    }

    public function test_throws_not_found_exception(): void
    {
        $userMock = Mockery::mock(UserModel::class);
        $userMock->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn(null);

        $repository = new DbalUserRepository($userMock);

        $this->expectException(UserNotFoundException::class);
        $repository->findUserById(1);
    }
}
