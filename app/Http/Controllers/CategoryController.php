<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryValidate;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    protected $Category;
    public function __construct(CategoryService $category)
    {
        $this->Category = $category;
    }

    public function store(CategoryValidate $request)
    {
        return $this->Category->store($request);
    }

    public function fetchAll()
    {
        return $this->Category->fetchAll();
    }

    public function search($name = '')
    {
        return $this->Category->search($name);
    }

    public function deleteCategory($id)
    {
        return $this->Category->deleteCategory($id);
    }

    public function TypesOfCategory($id)
    {
        return $this->Category->TypesOfCategory($id);
    }
}
