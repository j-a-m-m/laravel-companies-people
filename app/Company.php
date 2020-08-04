<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use \App\Http\Traits\UsesUuid;

    protected $fillable = ['uuid', 'name'];
}
