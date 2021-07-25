<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoanService;
use CommonHelper;
use Illuminate\Support\Facades\View;

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
        $result = $this->loanService->create($request->all());
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
        $result = $this->loanService->read($id);
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
        $result = $this->loanService->list();
        return response()->json([
            'success' => true,
            'data' => $result
        ], 200);
    }

}
