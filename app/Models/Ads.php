<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    //
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
