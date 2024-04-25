<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Models\Feature;

class FeatureController extends Controller
{

    public function store(FeatureStoreRequest $request)
    {
        $newFeature = new Feature();
        $newFeature->name = $request->name;
        $newFeature->save();

        return response()->json([
            'id' => $newFeature->id,
            'name' => $newFeature->name,
        ]);
    }
    public function update(FeatureUpdateRequest $request, string $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->name = $request->name;
        $feature->save();
        return ['response' => 'updated'];
    }


    public function destroy(string $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();
    }
}
