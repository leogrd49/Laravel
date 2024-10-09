<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/user/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/user/profile', [
                'prenom' => 'Test',
                'nom' => 'User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/user/profile');

        $user->refresh();

        $this->assertSame('Test', $user->prenom);
        $this->assertSame('User', $user->nom);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/user/profile', [
                'prenom' => 'Test',
                'nom' => 'User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/user/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/user/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_correct_password_must_be_provided_to_delete_account()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/user/profile')
            ->delete('/user/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/user/profile');

        $this->assertNotNull($user->fresh());
    }

    public function test_profile_update_with_invalid_data()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/user/profile', [
                'prenom' => '',
                'nom' => '',
                'email' => 'not-an-email',
            ]);

        $response->assertSessionHasErrors(['prenom', 'nom', 'email']);
    }

    public function test_profile_update_with_existing_email()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user1)
            ->patch('/user/profile', [
                'prenom' => 'Test',
                'nom' => 'User',
                'email' => $user2->email,
            ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_profile_delete_without_password()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/user/profile');

        $response->assertSessionHasErrorsIn('userDeletion', 'password');
        $this->assertNotNull($user->fresh());
    }

    public function test_profile_edit_unauthenticated()
    {
        $response = $this->get('/user/profile');

        $response->assertRedirect('/login');
    }

    public function test_profile_update_unauthenticated()
    {
        $response = $this->patch('/user/profile');

        $response->assertRedirect('/login');
    }

    public function test_profile_delete_unauthenticated()
    {
        $response = $this->delete('/user/profile');

        $response->assertRedirect('/login');
    }
}
