<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoUsers extends Model
{
    //
    protected $fillable = [
        "username",
        "promocode",
        "active",
        "date",
    ];
}
