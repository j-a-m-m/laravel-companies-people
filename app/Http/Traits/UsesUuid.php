<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait UsesUuid
{
  protected static function boot()
  {
      parent::boot();

      static::creating(function ($query) {
          $query->uuid = (string) Str::uuid();
      });
  }
}