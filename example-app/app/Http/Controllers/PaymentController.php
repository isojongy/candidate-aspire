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

    /**
     * getList.
     *
     */
    public function getList()
    {
        $result = $this->paymentService->list();
        return response()->json($result['res'], $result['code']);
    }

}
