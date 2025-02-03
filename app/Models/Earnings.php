<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earnings extends Model
{
    //
    protected $fillable = [
      "username",
      "amount",
      "time_of_deposit",
    ];
}
