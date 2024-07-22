<?php

namespace App\Services;

use App\Models\LibBook;
use App\Models\Library;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionService
{

    public function store($request)
    {
        try {
            $id = Auth::id();
            $lib = Library::where('user_id', $id)->first();
            if (empty($lib)) {
                return response()->json(['you have not library']);
            }
            $library = LibBook::where('book_id', $request->book_id)->where('library_id', $lib->id)->first();
            if (empty($library)) {
                return response()->json(['you can not add question on this the book']);
            }
            $input = $request->all();
            $input['user_id'] = Auth::id();
            Question::create($input);
            return response()->json(['message' => 'The question is added Successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $question = Question::find($id);
        if (empty($question)) {
            return response()->json(['message' => 'The question is not found'], 404);
        }
        if ($question->user_id == $user_id) {
            $question->delete();
            return response()->json(['message' => 'The question is deleted Successfully'], 200);
        }
        return response()->json(['message' => 'you can not delete this a question'], 403);
    }


    public function QuestionsOfBook($id)
    {
        $questions = Question::where('book_id', $id)->get();
        if (!count($questions)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $questions], 200);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $question = Question::find($id);
        if (empty($question)) {
            return response()->json(['message' => 'The question is not found'], 404);
        }
        if ($question->user_id == $user_id) {
            $question->body = $request->body;
            $question->save();
            return response()->json(['message' => 'The question is updated Successfully'], 200);
        }
        return response()->json(['message' => 'you can not update this a question'], 403);
    }
}
