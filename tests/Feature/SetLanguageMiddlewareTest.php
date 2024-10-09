<?php

namespace Tests\Feature;

use App\Http\Middleware\SetLanguageMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class SetLanguageMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected SetLanguageMiddleware $middleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new SetLanguageMiddleware;
    }

    public function testChangeLanguageWithPostRequest()
    {
        $request = Request::create('/test', 'POST', ['language' => 'fr']);
        $request->setLaravelSession($this->app['session.store']);

        $response = $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertEquals('fr', session('locale'));
        $this->assertEquals('fr', App::getLocale());
        $this->assertTrue($response->isRedirect());
    }

    public function testInvalidLanguageWithPostRequest()
    {
        $request = Request::create('/test', 'POST', ['language' => 'invalid']);
        $request->setLaravelSession($this->app['session.store']);

        $response = $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertNull(session('locale'));
        $this->assertEquals('en', App::getLocale()); // Assuming 'en' is the default locale
        $this->assertFalse($response->isRedirect());
    }

    public function testGetRequestWithSessionLocale()
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession($this->app['session.store']);
        session(['locale' => 'fr']);

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertEquals('fr', App::getLocale());
    }

    public function testGetRequestWithoutSessionLocale()
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession($this->app['session.store']);

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertEquals('en', App::getLocale()); // Assuming 'en' is the default locale
    }

    public function testNonStringSessionLocale()
    {
        $request = Request::create('/test', 'GET');
        $request->setLaravelSession($this->app['session.store']);
        session(['locale' => ['invalid']]);

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertEquals('en', App::getLocale()); // Assuming 'en' is the default locale
    }
}
