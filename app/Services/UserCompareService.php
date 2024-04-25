<?php

namespace App\Services;

use App\Models\Feature;
use App\Models\UserCompare;
use Illuminate\Support\Facades\Auth;

class UserCompareService
{
    public function getComparisons(): array
    {
        $properties = Auth::guard('user')->user()->compare;
        $features = Feature::all();
        return compact('properties', 'features');
    }

    public function storeComparison(string $userId, string $propertyId): ?UserCompare
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

    public function removeComparison(string $userId, string $propertyId): bool
    {
        $compare = UserCompare::where('property_id', $propertyId)->where('user_id', $userId)->first();
        if ($compare) {
            $compare->delete();
            return true;
        }
        return false;
    }


    public function resetComparisons(): void
    {
        UserCompare::truncate();
    }
}
