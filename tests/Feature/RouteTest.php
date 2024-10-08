<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    public function testWelcomeRoute()
    {
        $response = $this->get('/welcome');
        $response->assertStatus(200);
    }

    public function testDashboardRoute()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function testAuthenticatedDashboardRoute()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/');
    }

    public function testAbsenceRoute()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/absence');
        $response->assertStatus(200);
    }

    // public function testUserRoute()
    // {
    //     $user = \App\Models\User::factory()->create();
    //     $user->is_admin = true;
    //     $user->save();
    //     $response = $this->actingAs($user)->get('/user');
    //     $response->assertStatus(200);
    // }

    // public function testMotifRoute()
    // {
    //     $user = \App\Models\User::factory()->create();
    //     $user->is_admin = true;
    //     $user->save();
    //     $response = $this->actingAs($user)->get('/motif');
    //     $response->assertStatus(200);
    // }
}
