<?php

namespace Tests\Feature\Auth;

use App\Events\NewSignupEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class NewSignupEventTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    public function test_event_is_dispatched_when_user_registers(): void
    {
        Event::fake([
            NewSignupEvent::class
        ]);

        $response = $this->post('api/register', [
            'name' => 'Emmanuel Joseph',
            'email' => 'jimmy@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        Event::assertDispatched(NewSignupEvent::class);

    }

    public function test_notification_is_prompted()
    {
        $response = $this->post('api/register', [
            'name' => 'Emmanuel Joseph',
            'email' => 'jimmyss@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
    }
}
