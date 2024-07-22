<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use App\Models\notification as ModelsNotification;
use Kutia\Larafirebase\Facades\Larafirebase;

class SendNotificationListener
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(SendNotificationEvent $event): void
    {
        Larafirebase::withTitle($event->title)
        ->withBody($event->body)
        ->sendNotification($event->user->fcm_token);
        ModelsNotification::create(
            [
                'sender_id' => 1,
                'receiver_id' => $event->user->id,
                'title' => $event->title,
                'text' => $event->body
            ]
        );
    }
}
