<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorValidate;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $Author;
    public function __construct(AuthorService $author)
    {
        $this->Author = $author;
    }

    public function store(AuthorValidate $request)
    {
        return $this->Author->store($request);
    }

    public function fetchAll()
    {
        return $this->Author->fetch();
    }

    public function getAuthor($id)
    {
        return $this->Author->getAuthor($id);
    }

    public function search($name = '')
    {
        return $this->Author->search($name);
    }

    public function deleteAuthor($id)
    {
        return $this->Author->deleteAuthor($id);
    }

    public function BooksOfAuthor($id)
    {
        return $this->Author->BooksOfAuthor($id);
    }
}
