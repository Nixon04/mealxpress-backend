<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealList extends Model
{
    use HasFactory;
  protected $fillable = [
    
    'Meatname',
    'Meatprice',
    'Meatquantity',
    'option_status',
    'designated_schedule_future_time',
    'MeatWeight',
  ];
}
