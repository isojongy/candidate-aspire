<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Models\Payment;
use App\Exceptions\UpdateFailException;

class LoanRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Loan::class;
    }

}
