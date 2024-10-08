<?php

namespace Tests\Feature;

use Tests\TestCase;

class AccueilControllerTest extends TestCase
{
    public function test_index_route()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
