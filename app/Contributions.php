<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contributions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'partnership_id'];
}
