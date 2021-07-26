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

    /**
     * getList.
     *
     */
    public function getList()
    {
        $result = $this->loanService->list();
        return response()->json($result['res'], $result['code']);
    }

}
