<?php

namespace App\Services;

use App\Events\EvaluationBookEvent;
use App\Models\Book;
use App\Models\Evaluation;
use App\Models\LibBook;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class EvaluationService
{
    public function store($request)
    {
        try {
            $id = Auth::id();
            $lib = Library::where('user_id', $id)->first();
            if (empty($lib)) {
                return response()->json(['message' => 'you do not have a library'], 404);
            }
            $library = LibBook::where('book_id', $request->book_id)->where('library_id', $lib->id)->first();
            if (empty($library)) {
                return response()->json(['message' => 'The book is not found in your library'], 404);
            }
            $book = Book::find($request->book_id);
            if ((($book->pages) / 2) < $library->read_pages) {
                $input = $request->all();
                $input['user_id'] = $id;
                Evaluation::create($input);
                Event::dispatch(new EvaluationBookEvent($book));
                return response()->json(['message' => 'The book was successfully evaluated'], 200);
            }
            return response()->json(['message' => 'you can not evaluate this a book'], 403);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage()], 422);
        }
    }


    public function delete($id)
    {
        try {
            $user_id = Auth::id();
            $evaluation = Evaluation::find($id);
            if (empty($evaluation)) {
                return response()->json(['message' => 'The evaluation is Not Found'], 404);
            }
            if ($evaluation->user_id == $user_id) {
                $book = Book::find($evaluation->book_id);
                $evaluation->delete();
                Event::dispatch(new EvaluationBookEvent($book));
                return response()->json(['message' => 'The evaluation is deleted Successfully'], 200);
            }
            return response()->json(['message' => 'you can not delete this an evaluation'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
