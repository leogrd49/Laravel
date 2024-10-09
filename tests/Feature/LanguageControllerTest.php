<?php

namespace Tests\Feature;

use App\Http\Controllers\LanguageController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('app.available_locales', ['en', 'fr']);

        // Définir la route pour le test
        \Route::post('/change-language', [LanguageController::class, 'change'])->name('change.language');
    }

    public function test_change_language_to_french()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('change.language'), ['language' => 'fr']);
        $response->assertStatus(302); // Redirection
        $response->assertSessionHas('locale', 'fr');
        $this->assertEquals('fr', app()->getLocale());
    }

    public function test_change_language_to_english()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('change.language'), ['language' => 'en']);
        $response->assertStatus(302); // Redirection
        $response->assertSessionHas('locale', 'en');
        $this->assertEquals('en', app()->getLocale());
    }

    public function test_change_language_with_invalid_language()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('change.language'), ['language' => 'invalid']);
        $response->assertStatus(302); // Redirection due to validation failure
        $response->assertSessionHasErrors('language');
    }

    public function test_change_language_without_language_parameter()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('change.language'), []);
        $response->assertStatus(302); // Redirection due to validation failure
        $response->assertSessionHasErrors('language');
    }

    public function test_change_language_redirects_back()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->from('/test-page')->post(route('change.language'), ['language' => 'fr']);
        $response->assertRedirect('/test-page');
        $response->assertSessionHas('success');
    }

    public function test_language_controller_is_instantiable()
    {
        $controller = $this->app->make('App\Http\Controllers\LanguageController');
        $this->assertInstanceOf('App\Http\Controllers\LanguageController', $controller);
    }

    public function test_change_method_exists()
    {
        $controller = $this->app->make('App\Http\Controllers\LanguageController');
        $this->assertTrue(method_exists($controller, 'change'));
    }
}
