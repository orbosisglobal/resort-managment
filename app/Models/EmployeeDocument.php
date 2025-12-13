<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDocument extends Model
{
    use HasFactory, SoftDeletes;
    public function getImageUrlAttribute(): string
    {
        // Define storage path from config or fallback to a default path
        $storagePath = config('filesystems.path.storage.user_images', 'user_images');

        // Check if the image exists and return the full URL
        return $this->image ? Storage::disk('public')->url($storagePath . '/' . $this->image) : '';
    }
}
