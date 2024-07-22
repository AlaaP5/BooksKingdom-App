<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerValidate;
use App\Http\Requests\UpdateAnswerValidate;
use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $Answer;
    public function __construct(AnswerService $Answer)
    {
        $this->Answer = $Answer;
    }

    public function store(AnswerValidate $request)
    {
        return $this->Answer->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->Answer->update($id, $request);
    }
}
