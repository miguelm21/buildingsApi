<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'other_incomes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['headline', 'concept', 'amount', 'previousbalance', 'expense_id'];

}
