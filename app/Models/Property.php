<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    const STATUS_FOR_SALE = 0;
    const STATUS_FOR_RENT = 1;

    const STATUSES  = [
        self::STATUS_FOR_SALE => 'Sale',
        self::STATUS_FOR_RENT => 'Rent',
    ];

    const TYPE_APARTMENT = 0;
    const TYPE_HOUSE = 1;
    const TYPE_COMMERCIAL = 2;
    const TYPE_GARAGE = 3;
    const TYPE_LOFT = 4;

    const TYPES  = [
        self::TYPE_APARTMENT => 'Apartment',
        self::TYPE_HOUSE => 'House',
        self::TYPE_COMMERCIAL => 'Commercial',
        self::TYPE_GARAGE => 'Garage',
        self::TYPE_LOFT => 'Loft',
    ];

    const ROOMS_ONE = 1;
    const ROOMS_TWO = 2;
    const ROOMS_THREE = 3;
    const ROOMS_FOUR = 4;
    const ROOMS_FIVE = -5;
    const ROOMS_MORE = -1;

    const ROOMS_LABELS = [
        self::ROOMS_ONE => '1',
        self::ROOMS_TWO => '2',
        self::ROOMS_THREE => '3',
        self::ROOMS_FOUR => '4',
        self::ROOMS_FIVE => '5',
        self::ROOMS_MORE => '5+',
    ];

    const BUILDING_AGE_1 = 1;
    const BUILDING_AGE_5 = 5;
    const BUILDING_AGE_10 = 10;
    const BUILDING_AGE_20 = 20;
    const BUILDING_AGE_50 = 50;
    const BUILDING_AGE_51 = 51;

    const BUILDING_AGE_LABELS = [
        self::BUILDING_AGE_1 => '0 - 1 Years',
        self::BUILDING_AGE_5 => '0 - 5 Years',
        self::BUILDING_AGE_10 => '0 - 10 Years',
        self::BUILDING_AGE_20 => '0 - 20 Years',
        self::BUILDING_AGE_50 => '0 - 50 Years',
        self::BUILDING_AGE_51 => '50 + Years',
    ];

    const BEDBATH_1 = 1;
    const BEDBATH_2 = 2;
    const BEDBATH_3 = 3;
    const BEDBATH_4 = 4;
    const BEDBATH_5 = 5;

    const BEDBATH_LABELS = [
        self::BEDBATH_1 => '1',
        self::BEDBATH_2 => '2',
        self::BEDBATH_3 => '3',
        self::BEDBATH_4 => '4',
        self::BEDBATH_5 => '5',
    ];

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
