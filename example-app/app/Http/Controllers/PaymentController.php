<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaymentService;
use Validator;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    /**
     * postCreate.
     *
     */
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_id' => 'required|integer',
            'amount' => 'required|integer',
            'content' => 'nullable|string|max:500',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $result = $this->paymentService->create($request->all());
        return response()->json($result['res'], $result['code']);
    }

    /**
     * getRead.
     *
     */
    public function getRead($id)
    {
        $result = $this->paymentService->read($id);
        return response()->json($result['res'], $result['code']);
    }

}
