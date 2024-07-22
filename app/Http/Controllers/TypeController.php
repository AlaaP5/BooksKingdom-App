<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeValidate;
use App\Services\TypeService;

class TypeController extends Controller
{
    protected $Type;
    public function __construct(TypeService $category)
    {
        $this->Type = $category;
    }

    public function store(TypeValidate $request)
    {
        return $this->Type->store($request);
    }

    public function fetchAll()
    {
        return $this->Type->fetchAll();
    }

    public function search($name = '')
    {
        return $this->Type->search($name);
    }

    public function deleteType($id)
    {
        return $this->Type->deleteType($id);
    }

    public function BooksOfType($id)
    {
        return $this->Type->BooksOfType($id);
    }
}
