<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumbersValidation extends Model
{
    //
  protected $fillable = [
    'user_id',
    'phone_number',
    'token',
  ];
}
