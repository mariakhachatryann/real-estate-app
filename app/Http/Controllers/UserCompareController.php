<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompareRequest;
use App\Services\UserCompareService;
use Illuminate\Support\Facades\Auth;

class UserCompareController extends Controller
{
    protected $userCompareService;

    public function __construct(UserCompareService $userCompareService)
    {
        $this->userCompareService = $userCompareService;
    }

    public function index()
    {
        $data = $this->userCompareService->getComparisons();
        return view('user.compare', $data);
    }

    public function store(StoreCompareRequest $request)
    {
        $userId = Auth::guard('user')->user()->id;
        $propertyId = $request->propertyId;

        $comparisonEntry = $this->userCompareService->storeComparison($userId, $propertyId);

        if ($comparisonEntry) {
            return response()->json($comparisonEntry);
        } else {
            return response()->json(['error' => 'Comparison entry already exists'], 400);
        }
    }

    public function remove(string $propertyId)
    {
        $userId = Auth::guard('user')->user()->id;
        $this->userCompareService->removeComparison($userId, $propertyId);

        return redirect()->back()->with('success', 'Property removed from comparison.');
    }


    public function reset()
    {
        $this->userCompareService->resetComparisons();
        return redirect()->route('properties.index');
    }
}
