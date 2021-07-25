<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
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
    protected $table = 'payments';

    protected $hidden = ['deleted_at'];

    /**
     * gift relationship.
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
