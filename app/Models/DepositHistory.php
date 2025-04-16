<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    protected $fillable  = [
        'username',
        'amount',
        'status',
        'reference',
        'date_issued',
    ];
}
