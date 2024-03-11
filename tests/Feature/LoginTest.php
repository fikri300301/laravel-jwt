<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Test user can login with valid credentials.
     *
     * @return void
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
            'email' => 'fikri123@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => [
                         'id',
                         'name',
                         'email',
                     ],
                     'token',
                     'expired',
                 ]);
          
        
    }

    /**
     * Test user cannot login with invalid credentials.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson(['error' => 'Unauthorized']);
    }
}
   