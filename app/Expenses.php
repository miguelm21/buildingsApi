<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['concept', 'date', 'amount_a', 'amount_b', 'amount_c', 'provider_id', 'unit_id'];
}
