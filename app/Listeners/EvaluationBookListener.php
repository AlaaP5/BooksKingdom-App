<?php

namespace App\Listeners;

use App\Events\EvaluationBookEvent;
use App\Models\Book;
use App\Models\Evaluation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EvaluationBookListener
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
    public function handle(EvaluationBookEvent $event): void
    {
        $evaluations = Evaluation::where('book_id', $event->book->id)->get();
        $count = 0;
        $eva = 0.0;
        foreach ($evaluations as $evaluation) {
            $eva += $evaluation->rating;
            $count += 1;
        }
        $rating = $eva / $count;
        $book = Book::find($event->book->id);
        $book->evaluation = $rating;
        $book->save();
    }
}
