<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerSalaryDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manager_salary_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['detail', 'amount', 'manager_id'];
}
