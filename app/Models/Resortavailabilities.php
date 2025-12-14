<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resortavailabilities extends Model
{
   protected $fillable = [
        'resort_id', 'date', 'is_available'
    ];
}
