<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentsHistory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'amount', 'balance', 'observation', 'enterEnt', 'enterExp', 'enterDebt', 'unit_id'];
}
