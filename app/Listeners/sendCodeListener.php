<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Services\VerificationCodeService;

class sendCodeListener
{
    /**
     * Create the event listener.
     */
    protected $y;
    public function __construct(VerificationCodeService $y = null)
    {
        $this->y = $y;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateUserEvent $event): void
    {
        $this->y->sendCode($event->user);
    }
}
