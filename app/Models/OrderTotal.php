<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    use HasFactory;

    protected $fillable =[
      'market_id',
      'username',
      'delivery_amount',
      'service_fee',
      'sum_total',
      'total_amount',
      'status_point',
      'approvestat',
      'delivery_message',
      'delivery_address',
      'delivery_code',
    ];
}
