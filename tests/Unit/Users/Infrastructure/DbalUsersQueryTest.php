<?php

namespace Tests\Unit\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Users\Infrastructure\DbalUsersQuery;
use App\Models\User;
use DateTime;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class DbalUsersQueryTest extends TestCase
{
    public function test_execute_returns_paginated_user_resources(): void
    {
        $userMock = Mockery::mock(User::class);

        $mockUsers = [];
        for ($i = 1; $i <= 15; $i++) {
            $user = new User();
            $user->id = (string) $i;
            $user->name = "Test User {$i}";
            $user->email = "user{$i}@example.com";
            $user->created_at = new DateTime("2023-01-01 12:00:00");
            $mockUsers[] = $user;
        }

        $paginator = new LengthAwarePaginator(
            collect(array_slice($mockUsers, 0, 10)),
            count($mockUsers),
            10,
            1,
            ['path' => '']
        );

        $userMock->shouldReceive('paginate')
            ->once()
            ->with(10)
            ->andReturn($paginator);

        $dbalUsersQuery = new DbalUsersQuery($userMock);
        $result = $dbalUsersQuery->execute();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
        $result->each(function ($resource) {
            $this->assertInstanceOf(UserResource::class, $resource);
        });

        $this->assertCount(10, $result->items());
    }

    public function test_execute_throws_exception_if_no_users_found(): void
    {
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('paginate')
            ->once()
            ->with(10)
            ->andReturn(new LengthAwarePaginator(collect(), 0, 10));

        $dbalUsersQuery = new DbalUsersQuery($userMock);
        $this->expectException(UserNotFoundException::class);

        $dbalUsersQuery->execute();
    }
}
