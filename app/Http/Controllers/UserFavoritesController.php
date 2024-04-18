<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFavorites;
use Illuminate\Support\Facades\Auth;

class UserFavoritesController extends Controller
{
    public function index()
    {
        $favoriteProperties = Auth::guard('user')->user()->favorites;
        return view('user.favorites', compact('favoriteProperties'));
    }

    public function store(Request $request)
    {
        $userId = Auth::guard('user')->user()->id;
        $propertyId = $request->propertyId;

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

    public function remove(string $propertyId)
    {
        $favorite = UserFavorites::where('property_id', $propertyId)
            ->where('user_id', Auth::guard('user')->user()->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->route('favorites');
        } else {
            return response()->json(['error' => 'Favorite not found'], 404);
        }
    }
}
