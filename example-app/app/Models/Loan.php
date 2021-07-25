<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
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
    protected $table = 'loans';

    protected $hidden = ['deleted_at'];

    /**
     * user relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * loanPlan relationship.
     */
    public function loanPlan()
    {
        return $this->belongsTo(LoanPlan::class);
    }

    /**
     * payments relationship.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
