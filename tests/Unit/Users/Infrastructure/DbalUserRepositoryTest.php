<?php

namespace Tests\Unit\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Models\User as UserModel;
use App\Users\Domain\User;
use App\Users\Infrastructure\DbalUserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
class DbalUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_create_a_user(): void
    {
        $user = User::submit('John Doe', 'john@example.com', 'hashed_password');

        $repository = new DbalUserRepository(new UserModel());
        $repository->add($user);

        $this->assertDatabaseHas('users', [
            'uuid' => $user->getUuid()->toString(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
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
