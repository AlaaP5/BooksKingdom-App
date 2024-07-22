<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionValidate;
use App\Http\Requests\UpdateQuestionValidate;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    protected $Question;
    public function __construct(QuestionService $question)
    {
        $this->Question = $question;
    }

    public function store(QuestionValidate $request)
    {
        return $this->Question->store($request);
    }

    public function QuestionsOfBook($id)
    {
        return $this->Question->QuestionsOfBook($id);
    }

    public function delete($id)
    {
        return $this->Question->delete($id);
    }

    public function update(UpdateQuestionValidate $request, $id)
    {
        return $this->Question->update($id, $request);
    }
}
