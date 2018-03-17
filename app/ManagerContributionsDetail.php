<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerContributionsDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manager_contributions_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'manager_id'];
}
