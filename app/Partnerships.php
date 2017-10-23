<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partnerships extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partnerships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'number', 'suterhcode', 'address', 'neighborhood', 'cuitnumber', 'comment', 'balance', 'units', 'premises', 'parkingspaces', 'fee', 'user_id'];
}
