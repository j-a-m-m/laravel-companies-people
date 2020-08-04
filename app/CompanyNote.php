<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyNote extends Model
{
    //

    protected $fillable = ['message', 'company_id'];
}
