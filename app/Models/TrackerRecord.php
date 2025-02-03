<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerRecord extends Model
{
    use HasFactory;

    protected $fillable = [
       "username",
       "usercode",
       "cartreference",
       "locations",
       "status",
       "date",
    ];
}
