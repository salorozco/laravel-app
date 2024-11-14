<?php

namespace Tests\Unit\Users\Infrastructure;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

     public function test_user_index_returns_all_users(): void
     {
         // Arrange:
         User::factory()->count(3)->create();

         // Act:
         $response = $this->getJson('/api/users');

         // Assert
         $response->assertOk();
         $response->assertJsonCount(3);
     }

    public function test_user_index_returns_empty_array_when_no_users_exist(): void
    {
        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'User not found'
        ]);
    }

     public function test_user_show_returns_user(): void
     {
         // Arrange
         $user = User::factory()->create([
             'name' => 'Jane Doe',
             'email' => 'jane@example.com'
         ]);

         // Act
         $response = $this->getJson("/api/user/$user->id");
         $response->assertOk();

         // Assert
         $response->assertJson([
             'data' => [
                 'id' => (string) $user->id,
                 'name' => 'Jane Doe',
                 'email' => 'jane@example.com',
                 'joined_date' => $user->created_at->format('Y-m-d H:i:s')
             ]
         ]);
     }

    public function test_user_show_returns_404_if_user_not_found(): void
    {
        // Act
        $response = $this->getJson("/api/user/9999");

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'User not found'
        ]);
    }

     public function test_store_creates_user(): void
     {
         // Fake the events
         Event::fake();

         // Arrange:
         $userData = [
             'name' => 'John Doe',
             'email' => 'john@example.com',
             'password' => 'password123'
         ];

         // Act:
         $response = $this->postJson('/api/users', $userData);

         // Assert:
         $response->assertStatus(201);
         $this->assertDatabaseHas('users', [
             'name' => 'John Doe',
             'email' => 'john@example.com'
         ]);
     }

    public function test_store_user_fails_with_missing_fields(): void
    {
        // Act
        $response = $this->postJson('/api/users', [
            'name' => 'John Doe',
        ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }
}
