<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
     "username",
     "transfer_means",
     "transfer_method",
     "amount",
     "date",
     "status",
     "reference",
     "statement",
     "remark"
    ];

}
