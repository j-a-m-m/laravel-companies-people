<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    //

    protected $fillable = ['message', 'user_id'];
}
