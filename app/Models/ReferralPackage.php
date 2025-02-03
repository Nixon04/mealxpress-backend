<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
     'username',
     'reg_user',
     'reg_amount',
     'reg_transact_total',
     'earning_per_referral',
     'reg_total',
     'reg_status',
    ];
}
