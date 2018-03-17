<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationNotes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'information_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['desc', 'expense_id'];
}
