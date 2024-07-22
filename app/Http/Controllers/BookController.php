<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookValidate;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $Book;
    public function __construct(BookService $book)
    {
        $this->Book = $book;
    }

    public function store(BookValidate $request)
    {
        return $this->Book->store($request);
    }

    public function fetchAll()
    {
        return $this->Book->fetch();
    }

    public function getBook($id)
    {
        return $this->Book->getBook($id);
    }

    public function search($name = '')
    {
        return $this->Book->search($name);
    }

    public function updateBook($id, Request $request)
    {
        return $this->Book->update($id, $request);
    }

    public function deleteBook($id)
    {
        return $this->Book->deleteBook($id);
    }
}
