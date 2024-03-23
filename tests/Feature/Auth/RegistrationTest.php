<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_user_can_register(): void
    {
        $response = $this->post('api/register', [
            'name' => 'Emmanuel Joseph',
            'email' => 'jimmy@frn.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertCreated();
    }

    public function test_email_is_required()
    {
        $response = $this->post('api/register', [
            'name' => 'Emmanuel Joseph',
            'email' => '',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertUnprocessable();
    }

    public function test_password_is_required()
    {
        $response = $this->post('api/register', [
            'name' => 'Emmanuel Joseph',
            'email' => 'jamesBond@gmail.com',
            'password' => '',
            'password_confirmation' => '12345678'
        ]);

        $response->assertUnprocessable();
    }
}
