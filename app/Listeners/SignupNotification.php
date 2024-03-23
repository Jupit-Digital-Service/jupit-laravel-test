<?php

namespace App\Listeners;

use App\Events\NewSignupEvent;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class SignupNotification
{
    /**
     * Create the event listener.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(NewSignupEvent $event): bool
    {

        $response = Http::acceptJson()->post('http://127.0.0.1:3000/send-email', [
            'name' => $event->user->name,
            'email' => $event->user->email
        ]);

        return $response->Ok();
    }
}
