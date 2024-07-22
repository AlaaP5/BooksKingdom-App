<?php

namespace App\Services;

use App\Models\Solution;
use Illuminate\Support\Facades\Auth;

class SolutionService
{
    public function store($request)
    {
        $id = Auth::id();
        $input = $request->all();
        $input['user_id'] = $id;
        Solution::create($input);
        return response()->json(['message' => 'The Solution is added Successfully'], 201);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $solution = Solution::find($id);
        if (empty($solution)) {
            return response()->json(['message' => 'The solution is Not Found'], 404);
        }
        if ($solution->user_id == $user_id) {
            $solution->update([
                'body' => ($request->body) ? $request->body : $solution->body
            ]);
            return response()->json(['message' => 'The solution is updated Successfully'], 200);
        }
        return response()->json(['message' => 'you can not update this an solution'], 403);
    }
}
