<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckAdminMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CheckAdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    private CheckAdminMiddleware $middleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new CheckAdminMiddleware();
    }

    public function test_admin_user_can_access()
    {
        $adminUser = User::factory()->create(['admin' => true]);
        $request = Request::create('/admin', 'GET');
        $request->setUserResolver(function () use ($adminUser) {
            return $adminUser;
        });

        $response = $this->middleware->handle($request, function ($req) {
            return new Response();
        });

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_non_admin_user_cannot_access()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->expectExceptionMessage('Accès non autorisé.');

        $nonAdminUser = User::factory()->create(['admin' => false]);
        $request = Request::create('/admin', 'GET');
        $request->setUserResolver(function () use ($nonAdminUser) {
            return $nonAdminUser;
        });

        $this->middleware->handle($request, function ($req) {
            return new Response();
        });
    }

    public function test_unauthenticated_user_cannot_access()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->expectExceptionMessage('Accès non autorisé.');

        $request = Request::create('/admin', 'GET');
        $request->setUserResolver(function () {
            return null;
        });

        $this->middleware->handle($request, function ($req) {
            return new Response();
        });
    }
}
