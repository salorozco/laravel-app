<?php

namespace Tests\Feature\Users\Infrastructure;

use App\Framework\Exceptions\UserNotFoundException;
use App\Framework\Http\Resources\UserResource;
use App\Models\User;
use App\Users\Infrastructure\DbalUsersQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;

class DbalUserQueryFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected DbalUsersQuery $dbalUsersQuery;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dbalUsersQuery= new DbalUsersQuery(new User);
    }

    /**
     * @throws UserNotFoundException
     */
    public function test_it_returns_users():void
    {
        // Create some test users
        User::factory()->count(10)->create();
        $result = $this->dbalUsersQuery->execute();
        $this->assertNotEmpty($result);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function test_it_throws_exception_if_no_users_found():void
    {
        $this->expectException(UserNotFoundException::class);
        $this->dbalUsersQuery->execute();
    }


    /**
     * @throws UserNotFoundException
     */
    public function test_execute_returns_paginated_user_resources():void
    {
        // Create some test users
        User::factory()->count(15)->create();
        $result = $this->dbalUsersQuery->execute();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);

        $result->each(function ($resource) {
            $this->assertInstanceOf(UserResource::class, $resource);
        });

        $this->assertCount(10, $result->items());
    }

}
