<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyNotesValidate;
use App\Http\Requests\NoteValidate;
use App\Http\Requests\updateValidate;
use App\Services\NoteService;

class NoteController extends Controller
{
    protected $Note;
    public function __construct(NoteService $note)
    {
        $this->Note = $note;
    }

    public function store(NoteValidate $request)
    {
        return $this->Note->store($request);
    }

    public function myNotes(MyNotesValidate $request)
    {
        return $this->Note->myNotes($request);
    }

    public function deleteNote($id)
    {
        return $this->Note->deleteNote($id); //can you handle Data so ?  $id => Note
    }

    public function deleteNotes(MyNotesValidate $request)
    {
        return $this->Note->deleteNotes($request);
    }

    public function update($id, updateValidate $request)
    {
        return $this->Note->update($id, $request);
    }
}
