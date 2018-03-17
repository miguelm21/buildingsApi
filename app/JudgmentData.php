<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgmentData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'judgment_datas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['expedientnumber', 'place', 'object', 'status', 'amount', 'expense_id'];
}
