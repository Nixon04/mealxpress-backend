<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankLists extends Model
{
    use HasFactory;

    protected $fillable = [
        "bankid",
        "bank_name",
        "bank_image",
    ];
}
