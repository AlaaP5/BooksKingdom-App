<?php

namespace App\Services;

use App\Models\Book;
use App\Models\LibBook;
use App\Models\Library;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    public function store($request)
    {
        try {
            $id = Auth::id();
            $lib = Library::where('user_id', $id)->first();
            $library = LibBook::where('book_id', $request->book_id)->where('library_id', $lib->id)->first();
            if (empty($library)) {
                return response()->json(['message' => 'you can not add a note'], 403);
            } else {
                $book = Book::find($request->book_id);
                if ($book->pages < $request->page) {
                    return response()->json(['message' => 'you have exceeded the pages of the book'], 403);
                }
                $input = $request->all();
                $input['user_id'] = $id;
                Note::create($input);
                return response()->json(['message' => 'The Note is added Successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function myNotes($request)
    {
        $id = Auth::id();
        $notes = Note::where('book_id', $request->book_id)->where('user_id', $id)->where('page', $request->page)->get();
        if (count($notes))
            return response()->json(['data' => $notes], 200);
        return response()->json(['message' => 'not found'], 404);
    }


    public function deleteNote($id)
    {
        $id1 = Auth::id();
        $note = Note::find($id)->where('user_id', $id1)->first();
        if (empty($note)) {
            return response()->json(['message' => 'note is not found'], 404);
        }
        $note->delete();
        return response()->json(['message' => 'note deleted successfully'], 200);
    }


    public function deleteNotes($request)
    {
        $id1 = Auth::id();
        $notes = Note::where('book_id', $request->book_id)->where('user_id', $id1)->where('page', $request->page)->get();
        if (!count($notes)) {
            return response()->json(['message' => 'notes is not found'], 404);
        }
        foreach ($notes as $note) {
            $note->delete();
        }
        return response()->json(['message' => 'note deleted successfully'], 200);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $note = Note::where('id', $id)->where('user_id', $user_id)->first();
        if (empty($note)) {
            return response()->json(['message' => 'not found'], 404);
        }
        if ($note->user_id == $user_id) {
            $note->update([
                'body' => ($request->body) ? $request->body : $note->body
            ]);
            return response()->json(['message' => 'your note has been modified'], 200);
        }
        return response()->json(['message' => 'you can not update this a note'], 403);
    }
}
