<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderList extends Model
{
    use HasFactory;

    protected $fillable = [
      'username',
      'marketid',
      'productname',
      'price',
      'portion',
      'total',
      'option',
      'cartimage',
      'cartweight',
      'cartreference',
      'cartdrink',
      'cartpremit',
      'cartstatus',
      'cartrefcode',
      'cartpurchasedate',
    ];
}
