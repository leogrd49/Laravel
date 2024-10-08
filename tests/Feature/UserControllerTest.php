<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route()
    {
        $user = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($user)->get('/user');
        $response->assertStatus(200);
    }

    public function test_create_route()
    {
        $user = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($user)->get('/user/create');
        $response->assertStatus(200);
    }
}
