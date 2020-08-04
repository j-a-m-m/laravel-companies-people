<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // Add auto-generated UUID trait (does not replace default primary key)
    use \App\Http\Traits\UsesUuid;

    protected $fillable = ['uuid', 'name'];

    public function notes()
    {
        return $this->hasMany('App\CompanyNote');
    }
}
