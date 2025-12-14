<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Resortpartners extends Authenticatable
{
    protected $table = 'resortpartners';

    protected $fillable = [
        'resort_id',
        'name',
        'email',
        'password',
    ];
}
