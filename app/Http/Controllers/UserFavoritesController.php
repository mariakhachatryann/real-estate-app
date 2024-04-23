<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoritesRequest;
use App\Services\UserFavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFavoritesController extends Controller
{
    protected $userFavoriteService;

    public function __construct(UserFavoriteService $userFavoriteService)
    {
        $this->userFavoriteService = $userFavoriteService;
    }
    public function index()
    {
        $favoriteProperties = $this->userFavoriteService->getUserFavorites();
        return view('user.favorites',$favoriteProperties);
    }

    public function store(StoreFavoritesRequest $request)
    {
        $userId = Auth::guard('user')->user()->id;
        $propertyId = $request->propertyId;

        $this->userFavoriteService->storeFavorite($userId, $propertyId);
    }

    public function remove(string $propertyId)
    {
        $userId = Auth::guard('user')->user()->id;

        if ($this->userFavoriteService->removeFavorite($userId, $propertyId)) {
            return redirect()->route('favorites');
        } else {
            return response()->json(['error' => 'Favorite not found'], 404);
        }
    }
}
