<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidentifiedDeposits extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'unidentified_deposits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'import', 'expense_id'];
}
