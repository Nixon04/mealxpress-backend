<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionCollection extends Model
{
    use HasFactory;
    protected $fillable = [
    "versionName",
    "versionmessage",
    "versionsubmessage",
    "versionStatus"
    ];
}
