<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersUnits extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['datestart', 'datestart2', 'dateend', 'dateend2', 'type', 'description', 'summary', 'attachment', 'codepayment', 'noticeamountpayment', 'noticedatepayment', 'noticedescpayment', 'user_id'];
}
