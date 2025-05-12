<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorisationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_restricted(): void
    {
        $response = $this->get('/orders');

        $response->assertStatus(302);
    }
}
