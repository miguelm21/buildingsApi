<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Managers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'managers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cuilnumber', 'partnership_number', 'date', 'category', 'spending', 'charge', 'period', 'unit_id'];
}
