<?php

namespace App\Services;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintService
{
    public function store($request)
    {
        $id = Auth::id();
        $input = $request->all();
        $input['user_id'] = $id;
        Complaint::create($input);
        return response()->json(['message' => 'The complaint is added Successfully'], 201);
    }


    public function complaints()
    {
        $id = Auth::id();
        $complaints = Complaint::where('user_id', $id)->get();
        if (!count($complaints)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $complaints], 200);
    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $complaint = Complaint::find($id);
        if (empty($complaint)) {
            return response()->json(['message' => 'The complaint is Not Found'], 404);
        }
        if ($complaint->user_id == $user_id) {
            $complaint->delete();
            return response()->json(['message' => 'The complaint is deleted Successfully'], 200);
        }
        return response()->json(['message' => 'you can not delete this a complaint'], 403);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $complaint = Complaint::find($id);
        if (empty($complaint)) {
            return response()->json(['message' => 'The complaint is Not Found'], 404);
        }
        if ($complaint->user_id == $user_id) {
            $complaint->update([
                'body' => ($request->body) ? $request->body : $complaint->body
            ]);
            return response()->json(['message' => 'The complaint is updated Successfully'], 200);
        }
        return response()->json(['message' => 'you can not update this a complaint'], 403);
    }
}
