<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsCredentials extends Model
{
    use HasFactory;

    protected $fillable = [
     "vendorsMarketId",
     "password",
     "contact",
     "email_address",
     "code",
     "last_updated",
     'sendermail',
     'legalbusiness', 
     'fcm_token',
     'city',
     'state',
     "info_check",
     "date_of_reg",
    ];
}
