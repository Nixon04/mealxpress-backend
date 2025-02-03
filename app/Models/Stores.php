<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;

    protected $fillable = [
        "marketstoreid",
        "marketstorename",
        "marketstorebio",
        "marketstorelinks",
        "marketstorebadge",
        "marketreg", 
        "marketstatus",
        "marketsupportcourse",
        "marketstoreprofile",
        "marketstorecollection",
        "marketstoreaddress",
        "activehours",
        "session",
    ];
}
