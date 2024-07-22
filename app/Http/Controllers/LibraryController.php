<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLibrary;
use App\Http\Requests\MyNotesValidate;
use App\Services\LibraryService;

class LibraryController extends Controller
{
    protected $Library;
    public function __construct(LibraryService $lib)
    {
        $this->Library = $lib;
    }

    public function add(AddLibrary $request)
    {
        return $this->Library->add($request);
    }

    public function booksOfCondition($id)
    {
        return $this->Library->booksOfCondition($id);
    }

    public function addSign(MyNotesValidate $request)
    {
        return $this->Library->addSign($request);
    }
}
