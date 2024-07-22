<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationValidate;
use App\Services\EvaluationService;

class EvaluationController extends Controller
{

    protected $Evaluation;
    public function __construct(EvaluationService $evaluation)
    {
        $this->Evaluation = $evaluation;
    }

    public function store(EvaluationValidate $request)
    {
        return $this->Evaluation->store($request);
    }

    public function delete($id)
    {
        return $this->Evaluation->delete($id);
    }
}
