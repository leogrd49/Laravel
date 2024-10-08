<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_user()
    {
        $admin = User::factory()->create(['admin' => true]);
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->actingAs($admin)->post('/user', $userData);

        $response->assertStatus(302); // Assuming it redirects after creation
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();
        $updatedData = ['name' => 'Updated Name'];

        $response = $this->actingAs($user)->patch("/user/{$user->id}", $updatedData);

        $response->assertStatus(302); // Assuming it redirects after update
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }
}
