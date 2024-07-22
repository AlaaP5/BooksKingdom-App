<?php

namespace App\Listeners;

use App\Events\EvaluationEvent;
use App\Models\Type;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class evaluationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EvaluationEvent $event): void
    {
        $user=User::find($event->lib->user_id);
        //$type=Type::find($event->book->type_id);

        $user->evaluation=((($event->lib->read_pages)/($event->lib->all_pages))*5); // مبتدئ ومتوسط ومتقدم هكذا ستكون التقييمات
        $user->save();
    }
}
