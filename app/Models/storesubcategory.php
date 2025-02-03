<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storesubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
      "marketid",
      "categoryid",
      "categoryname",
      "categorylistdropdown",
      "flag",
      "status",
    ];
}
