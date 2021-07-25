<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Payment::class;
    }

}
