<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllMarkets extends Model
{
    use HasFactory;

    protected $fillable  = [
     'marketproductid',
     'marketproductweight',
     'marketimage',
     'marketstoredimages',
     'marketproductprice',
     'marketproductname',
     'marketproductrequired',
     'marketproductoption',
     'marketproducttotal_portion',
     'marketproductorder_date',
     'marketproductlink',
    
    ];
}
