<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['department', 'departmentnumber', 'date', 'amount', 'observation', 'unit_id'];
}
