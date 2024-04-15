<?php

namespace App\Models;

use App\Http\Controllers\FeaturesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function address()
    {
        return $this->hasOne(PropertyAddress::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'property_features');
    }
}
