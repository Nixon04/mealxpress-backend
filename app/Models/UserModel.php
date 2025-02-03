<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $fillable  = [
       "fullname",
       "username",
       "email",
       "contact",
       "password",
       "flag",
       "code",
       "referral_code",
       "referralidtag",
       "image",
       "fcm_token",
    ];
}
