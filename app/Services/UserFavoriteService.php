<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFavorites;

class UserFavoriteService
{
    public function getUserFavorites()
    {
        $favoriteProperties = Auth::guard('user')->user()->favorites;
        return compact('favoriteProperties');
    }

    public function storeFavorite($userId, $propertyId)
    {
        $existingFavorite = UserFavorites::where('property_id', $propertyId)
            ->where('user_id', $userId)
            ->first();

        if (!$existingFavorite) {
            $favorite = new UserFavorites();
            $favorite->property_id = $propertyId;
            $favorite->user_id = $userId;
            $favorite->save();
        }
    }

    public function removeFavorite($userId, $propertyId)
    {
        $favorite = UserFavorites::where('property_id', $propertyId)
            ->where('user_id', $userId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return true;
        }

        return false;
    }
}
