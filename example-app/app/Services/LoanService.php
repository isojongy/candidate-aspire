<?php

namespace App\Services;

use App\Common\Constants\Common;
use App\Repositories\LoanRepository;
use App\Repositories\LoanPlanRepository;
use App\Repositories\UserRepository;
use App\Exceptions\AjaxFailException;
use Log;
use Exception;
use Auth;

/**
 */
class LoanService
{
    /**
     * Main repository.
     */
    public function __construct()
    {
        $this->loanRepository = app()->make(LoanRepository::class);
        $this->loanPlanRepository = app()->make(LoanPlanRepository::class);
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * create
     */
    public function create($request)
    {
        try {
            $request['user_id'] = Auth::user()->id;

            $loanPlan = $this->loanPlanRepository->find($request['loan_plan_id']);
            if (empty($loanPlan)) {
                return [
                    'res' => [
                        'success' => true,
                        'message' => 'Loan plan is not found',
                    ],
                    'code' => 400,
                ];
            }
            // dd($loanPlan);

            $request['interest_rate'] = $loanPlan->interest_rate;
            $request['penalty_rate'] = $loanPlan->penalty_rate;
            $request['total_amount'] = $request['remain_amount'] = round($request['origin_amount'] * (1 + $loanPlan->interest_rate / 100));
            $request['daily_amount'] = round($request['total_amount'] / 365);
            $request['penalty_amount'] = round($request['daily_amount'] * ($loanPlan->penalty_rate / 100));
            // dd($request);
            $record = $this->loanRepository->create($request);
            return [
                'res' => [
                    'success' => true,
                    'data' => $record,
                ],
                'code' => 200,
            ];
        }
        catch(Exception $ex){
            return [
                'res' => [
                    'success' => true,
                    'message' => $ex->getMessage(),
                ],
                'code' => 500,
            ];
        }
    }

    /**
     * read
     */
    public function read($id){
        try {
            $record = $this->loanRepository->find($id);
            return [
                'res' => [
                    'success' => true,
                    'data' => $record,
                ],
                'code' => 200,
            ];
        }
        catch (Exception $ex){
            return [
                'res' => [
                    'success' => false,
                    'message' => $ex->getMessage(),
                ],
                'code' => 500,
            ];
        }
    }

    /**
     * list
     */
    public function list(){
        $userId = Auth::user()->id;
        $conditions = [
            'user_id' => $userId,
        ];
        $records = $this->loanRepository->getByConditions($conditions);
        return [
            'res' => [
                'success' => true,
                'data' => $records,
            ],
            'code' => 200,
        ];
    }

}
