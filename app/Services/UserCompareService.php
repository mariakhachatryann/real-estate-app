<?php

namespace App\Services;

use App\Models\Feature;
use App\Models\UserCompare;
use Illuminate\Support\Facades\Auth;

class UserCompareService
{
    public function getComparisons()
    {
        $properties = Auth::guard('user')->user()->compare;
        $features = Feature::all();
        return compact('properties', 'features');
    }

    public function storeComparison($userId, $propertyId)
    {
        $existingCompare = UserCompare::where('property_id', $propertyId)
            ->where('user_id', $userId)
            ->first();

        if (!$existingCompare) {
            $compare = new UserCompare();
            $compare->property_id = $propertyId;
            $compare->user_id = $userId;
            $compare->save();

            return UserCompare::with('property.images')->find($compare->id);
        }

        return null;
    }

    public function removeComparison($userId, $propertyId)
    {
        $compare = UserCompare::where('property_id', $propertyId)->where('user_id', $userId)->first();
        if ($compare) {
            $compare->delete();
            return true; // Return a success message or handle as needed
        }
        return false; // Handle case where no matching record is found
    }


    public function resetComparisons()
    {
        UserCompare::truncate();
    }
}
