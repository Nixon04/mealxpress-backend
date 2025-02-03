<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversPersonalInfo extends Model
{
    use HasFactory;

    protected $fillable  = [
     "firstname",
     "lastname",
     'username',
     "email",
     "contact",
     'password',
     "nextofkin",
     "fcm_token",
     "kincontact",
     "image",
     "trackerid",
    ];
}
