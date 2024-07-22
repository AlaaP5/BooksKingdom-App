<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolutionValidate;
use App\Services\SolutionService;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    protected $Solution;
    public function __construct(SolutionService $Solution)
    {
        $this->Solution = $Solution;
    }

    public function store(SolutionValidate $request)
    {
        return $this->Solution->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->Solution->update($id, $request);
    }
}
