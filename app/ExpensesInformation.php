<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesInformation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses_informations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['bank', 'sucursal', 'headline', 'account', 'cbu', 'expense_id'];
}
