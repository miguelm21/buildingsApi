<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'residence', 'zipcode', 'cuitnumber', 'phone', 'rpaenrollment', 'fiscalsituation', 'email', 'website', 'user_id'];
}
