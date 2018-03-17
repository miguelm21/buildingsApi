<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesHistory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partnerships_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['igPorDeuda', 'igPorExpMes', 'igPorInt', 'igPorExtra', 'egresos', 'previousBalance', 'totalIg', 'date', 'partnership_id'];
}
