<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartTotal extends Model
{
    use HasFactory;

    protected $fillable = [
       "username",
       "marketid",
       "productname",
       "price",
       "portion",
       "total",
       "option",
    ];
}
