<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodes extends Model
{
    //
    protected $fillable = [
        "promocode",
        "expired",
        "price",
        "date",
    ];
}
