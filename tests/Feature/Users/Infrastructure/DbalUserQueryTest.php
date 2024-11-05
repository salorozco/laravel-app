<?php

namespace Tests\Feature\Users\Infrastructure;

//use App\Framework\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Users\Infrastructure\DbalUsersQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DbalUserQueryTest extends TestCase
{
    use RefreshDatabase;

    protected DbalUsersQuery $dbalUsersQuery;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialize the DbalUsersQuery with the User model dependency
        $this->dbalUsersQuery = new DbalUsersQuery(new User());

        // Ensure the database is ready and add sample data
        User::factory()->count(4)->create();

    }

    public function test_it_returns_users()
    {
        $result = $this->dbalUsersQuery->execute();
        $this->assertNotEmpty($result);
    }


}
