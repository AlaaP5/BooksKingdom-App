<?php

namespace App\Providers;

use App\Events\CreateUserEvent;
use App\Events\EvaluationBookEvent;
use App\Events\EvaluationEvent;
use App\Events\SendNotificationEvent;
use App\Listeners\EvaluationBookListener;
use App\Listeners\EvaluationListener;
use App\Listeners\sendCodeListener;
use App\Listeners\SendNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EvaluationEvent::class => [
            EvaluationListener::class,
        ],

        CreateUserEvent::class => [
            sendCodeListener::class,
        ],

        EvaluationBookEvent::class=>[
            EvaluationBookListener::class,
        ],

        SendNotificationEvent::class=>[
            SendNotificationListener::class,
        ],


    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
