<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutMethods extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        "payout",
        "recipient",
        "amount",
        "settleamount",
        "referencecode",
        "status"
    ];
}
