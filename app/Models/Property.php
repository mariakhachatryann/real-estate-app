<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function amentites(): HasMany
    {
        return $this->hasMany(Amentity::class);
    }
}
