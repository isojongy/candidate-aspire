<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPlan extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan_plans';

    protected $hidden = ['deleted_at'];

    /**
     * loan relationship.
     */
    public function loan()
    {
        return $this->hasMany(Loan::class);
    }
}
