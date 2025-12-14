<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    protected $table = 'resorts';

    protected $fillable = [
        'name',
        'address',
        'capacity',
        'styles',
        'image',
        'is_active',
    ];

    protected $casts = [
        'image' => 'array', // ⭐ THIS ENABLES MULTI IMAGE
    ];
    public function partner()
    {
        return $this->hasOne(Resortpartners::class, 'resort_id');
    }

    public function availability()
    {
        return $this->hasMany(Resortavailabilities::class);
    }
}
