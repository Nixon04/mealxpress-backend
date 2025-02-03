<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marketsubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketid',
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
        'marketproduct_link',
    ];
}
