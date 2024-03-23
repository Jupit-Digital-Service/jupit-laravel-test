<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_user_can_login(): void
    {
        $response = $this->post('api/login', [
            'email' => 'jimmy@frn.com',
            'password' => '12345678',
        ]);

        $response->assertOk();
    }

    public function test_email_is_required(): void
    {
        $response = $this->post('api/login', [
            'email' => '',
            'password' => '12345678',
        ]);

        $response->assertUnprocessable();
    }

    public function test_password_is_required(): void
    {
        $response = $this->post('api/login', [
            'email' => 'jimmy@frn.com',
            'password' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_invalid_credentials(): void
    {
        $response = $this->post('api/login', [
            'email' => 'jimmy@frn.com',
            'password' => '12345678910',
        ]);

        $response->assertBadRequest();
    }
}
