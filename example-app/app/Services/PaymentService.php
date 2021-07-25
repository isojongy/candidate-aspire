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
                return false;
            }

            if($loan->remain_amount == 0){
                return false;
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
                return false;
            }

            DB::commit();
            return $record;
        }
        catch(Exception $ex){
            Log::error('err create payment '. $ex->getMessage());
            DB::rollback();
            return false;
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
