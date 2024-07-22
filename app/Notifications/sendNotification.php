<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class sendNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $fcmTokens;
    // $arratoken,$data,$title,$body
    public function __construct($title,$body,$fcmTokens)
    {
        $this->title = $title;
        $this->body = $body;
        $this->fcmTokens = [$fcmTokens];
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
                    ->withTitle($this->title)
                    ->withBody($this->body)
                    ->asNotification($this->fcmTokens);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
