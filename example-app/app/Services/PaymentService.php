<?php

namespace App\Services;

use App\Common\Constants\Common;
use App\Repositories\LoanRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Exceptions\AjaxFailException;
use Log;
use Exception;
use Auth;
use DB;
use Str;

/**
 */
class PaymentService
{
    /**
     * Main repository.
     */
    public function __construct()
    {
        $this->loanRepository = app()->make(LoanRepository::class);
        $this->paymentRepository = app()->make(PaymentRepository::class);
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * create
     */
    public function create($request)
    {
        DB::beginTransaction();

        $request['user_id'] = Auth::user()->id;
        try{
            $loan = $this->loanRepository->find($request['loan_id']);
            if(empty($loan)){
                return [
                    'res' => [
                        'success' => false,
                        'message' => 'This loan is not found',
                    ],
                    'code' => 404,
                ];
            }

            if($loan->remain_amount == 0){
                return [
                    'res' => [
                        'success' => false,
                        'message' => 'This loan has been paid',
                    ],
                    'code' => 400,
                ];
            }

            //create payment
            $paidAmount = $loan->paid_amount + $request['amount'];
            $penaltyFee = 1 * $loan->penalty_amount;
            $remainAmount = max($loan->remain_amount - $request['amount'] + $penaltyFee, 0);

            $request['ref_no'] = Str::upper(substr(md5(uniqid(mt_rand(), true)) , 0, 12));
            $request['paid_amount'] = $paidAmount;
            $request['remain_amount'] = $remainAmount;
            $request['total_amount'] = $loan->total_amount;
            $request['penalty_fee'] = $penaltyFee;
            // dd($request);

            $record = $this->paymentRepository->create($request);

            //update loan
            $updateData = [
                'paid_amount' => $paidAmount,
                'remain_amount' => $remainAmount,
            ];
            $where = [
                'id' => $loan->id,
            ];
            $updateLoan = $this->loanRepository->updateFirstByConditions($updateData, $where);
            if(!$updateLoan){
                DB::rollback();
                return [
                    'res' => [
                        'success' => false,
                        'message' => 'Please try again',
                    ],
                    'code' => 400,
                ];
            }

            DB::commit();
            return [
                'res' => [
                    'success' => true,
                    'data' => $record,
                ],
                'code' => 200,
            ];
        }
        catch(Exception $ex){
            DB::rollback();
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
     * read
     */
    public function read($id){
        try {
            $record = $this->paymentRepository->find($id);
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
        return $this->paymentRepository->list($userId);
    }

}
