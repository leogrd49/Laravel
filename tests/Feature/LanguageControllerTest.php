<?php

namespace Tests\Feature;

use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    public function test_change_language()
    {
        $response = $this->get('/change-language/fr');
        $response->assertStatus(302);
        $this->assertEquals('fr', session('locale'));
    }
}
