<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaymentService;
use CommonHelper;
use Illuminate\Support\Facades\View;

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
        $result = $this->paymentService->create($request->all());
        if ($result) {
            return response()->json([
                'success' => true,
                'data' => $result
            ], 201);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    /**
     * getRead.
     *
     */
    public function getRead($id)
    {
        $result = $this->paymentService->read($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'data' => $result
            ], 200);
        }
        else{
            return response()->json(['success' => false], 404);
        }
    }

    /**
     * getList.
     *
     */
    public function getList()
    {
        $result = $this->paymentService->list();
        return response()->json([
            'success' => true,
            'data' => $result
        ], 200);
    }

}
