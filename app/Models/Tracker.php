<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    protected $fillable = [
     'marketid',
     'tracker_id',
     'tracker_current_status_holder',
     'tracker_history',
     'tracker_code',
     'tracker_courier_name',
     'tracker_courier_contact',
     'tracker_courier_image',
     'tracker_status',
    ];
}
