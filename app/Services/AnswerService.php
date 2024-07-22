<?php

namespace App\Services;

use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
    public function store($request)
    {
        $id = Auth::id();
        $input = $request->all();
        $input['user_id'] = $id;
        Answer::create($input);
        return response()->json(['message' => 'The answer is added Successfully'], 201);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $answer = Answer::find($id);
        if (empty($answer)) {
            return response()->json(['message' => 'The answer is Not Found'], 404);
        }
        if ($answer->user_id == $user_id) {
            $answer->update([
                'body' => ($request->body) ? $request->body : $answer->body
            ]);
            return response()->json(['message' => 'The answer is updated Successfully'], 200);
        }
        return response()->json(['message' => 'you can not update this an answer'], 403);
    }
}
