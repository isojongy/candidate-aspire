<?php

namespace App\Repositories;

use App\Models\LoanPlan;
use App\Exceptions\UpdateFailException;

class LoanPlanRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return LoanPlan::class;
    }

}
