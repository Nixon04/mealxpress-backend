<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivePlaces extends Model
{
    //

    protected $fillable = [
        'states',
        'regions',
        'status',
        'date_issued',
    ];
}
