<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoanService;
use Validator;

class LoanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->loanService = app()->make(LoanService::class);
    }

    /**
     * postCreate.
     *
     */
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_plan_id' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'arrangement_fee' => 'required|integer',
            'origin_amount' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $result = $this->loanService->create($request->all());
        return response()->json($result['res'], $result['code']);
    }

    /**
     * getRead.
     *
     */
    public function getRead($id)
    {
        $result = $this->loanService->read($id);
        return response()->json($result['res'], $result['code']);
    }

}
