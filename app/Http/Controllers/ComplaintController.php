<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintValidate;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

    protected $Complaint;
    public function __construct(ComplaintService $complaint)
    {
        $this->Complaint = $complaint;
    }

    public function store(ComplaintValidate $request)
    {
        return $this->Complaint->store($request);
    }

    public function complaints()
    {
        return $this->Complaint->complaints();
    }

    public function update($id, Request $request)
    {
        return $this->Complaint->update($id, $request);
    }

    public function delete($id)
    {
        return $this->Complaint->delete($id);
    }
}
