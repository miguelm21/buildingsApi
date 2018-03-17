<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesBalace extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses_balaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'date', 'amount_a', 'amount_b', 'amount_c', 'rubro', 'concept', 'period', 'provider_id', 'expense_id'];
}
