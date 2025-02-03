<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkList extends Model
{
    use HasFactory;
 
    protected $fillable = [
    'drinkname',
    'drinkprice',
    'drinkimage',
    'drinkquantity',
    'option_status',
    'designated_schedule_future_time',
    ];
}
