<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\State;
class City extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setNameAttribute($value){
        $this->attributes['name']=ucwords($value);
    }
   public function state(): BelongsTo
{
    return $this->belongsTo(State::class, 'state_id', 'id');
}
}