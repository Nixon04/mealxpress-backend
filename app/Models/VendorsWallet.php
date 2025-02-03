<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsWallet extends Model
{
    use HasFactory;
    protected $fillable = [
        "username",
        "accountbalance",
        "flag"
    ];
}
