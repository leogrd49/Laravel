<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\AccueilController;
use Illuminate\Support\Facades\Route;

class AccueilControllerTest extends TestCase
{
    public function test_index_route()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function test_index_route_returns_welcome_view()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }

    public function test_accueil_controller_is_instantiable()
    {
        $controller = new AccueilController();
        $this->assertInstanceOf(AccueilController::class, $controller);
    }

    public function test_index_method_returns_view()
    {
        $controller = new AccueilController();
        $response = $controller->index();
        $this->assertEquals('welcome', $response->name());
    }

    public function test_route_uses_correct_controller_method()
    {
        $this->assertTrue(Route::has('accueil'));
        $route = Route::getRoutes()->getByName('accueil');
        $this->assertEquals('App\Http\Controllers\AccueilController@index', $route->getAction('uses'));
    }

}
