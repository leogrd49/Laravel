<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Motif;
use App\Models\Absence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['admin' => true]);
    }

    public function test_index_route_for_admin()
    {
        $response = $this->actingAs($this->admin)->get('/user');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHas('users');
    }

    public function test_index_route_for_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $response = $this->actingAs($user)->get('/user');
        $response->assertStatus(403);
    }

    public function test_create_route_for_admin()
    {
        $response = $this->actingAs($this->admin)->get('/user/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.create');
    }

    public function test_create_route_for_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $response = $this->actingAs($user)->get('/user/create');
        $response->assertStatus(403);
    }

    public function test_store_user_as_admin()
    {
        $userData = [
            'prenom' => 'John',
            'nom' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->actingAs($this->admin)->post('/user', $userData);

        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'prenom' => 'John',
            'nom' => 'Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_store_user_as_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $userData = [
            'prenom' => 'John',
            'nom' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->actingAs($user)->post('/user', $userData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', ['email' => 'john@example.com']);
    }

    public function test_show_user_as_admin()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $user->id, 'motif_id' => $motif->id]);

        $response = $this->actingAs($this->admin)->get("/user/{$user->id}");

        $response->assertStatus(200);
        $response->assertViewIs('user.show');
        $response->assertViewHas(['user', 'absences', 'motifs']);
    }

    public function test_show_user_as_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->get("/user/{$otherUser->id}");

        $response->assertStatus(403);
    }

    public function test_edit_user_as_admin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->get("/user/{$user->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('user.edit');
        $response->assertViewHas('user');
    }

    public function test_edit_user_as_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->get("/user/{$otherUser->id}/edit");

        $response->assertStatus(403);
    }

    public function test_update_user_as_admin()
    {
        $user = User::factory()->create();
        $updatedData = [
            'prenom' => 'Updated',
            'nom' => 'User',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->actingAs($this->admin)->put("/user/{$user->id}", $updatedData);

        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'prenom' => 'Updated',
            'nom' => 'User',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_update_user_as_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();
        $updatedData = [
            'prenom' => 'Updated',
            'nom' => 'User',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->actingAs($user)->put("/user/{$otherUser->id}", $updatedData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', [
            'id' => $otherUser->id,
            'email' => 'updated@example.com',
        ]);
    }

    public function test_destroy_user_as_admin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->delete("/user/{$user->id}");

        $response->assertRedirect(route('user.index'));
        $this->assertSoftDeleted($user);
    }

    public function test_destroy_user_as_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->delete("/user/{$otherUser->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('users', ['id' => $otherUser->id]);
    }

    public function test_store_user_with_invalid_data()
    {
        $invalidUserData = [
            'prenom' => '',
            'nom' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ];

        $response = $this->actingAs($this->admin)->post('/user', $invalidUserData);

        $response->assertSessionHasErrors(['prenom', 'nom', 'email', 'password']);
    }

    public function test_update_user_with_invalid_data()
    {
        $user = User::factory()->create();
        $invalidUserData = [
            'prenom' => '',
            'nom' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ];

        $response = $this->actingAs($this->admin)->put("/user/{$user->id}", $invalidUserData);

        $response->assertSessionHasErrors(['prenom', 'nom', 'email', 'password']);
    }
}
