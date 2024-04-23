<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPropertyRequest;
use App\Http\Requests\PropertyImageRequest;
use App\Http\Requests\SearchPropertyRequest;
use App\Models\Feature;
use App\Models\PropertyImage;
use App\Services\PropertyService;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index()
    {
        $data = $this->propertyService->getIndexData();
        return view('properties.index', $data);
    }

    public function create()
    {
        $features = Feature::all();
        return view('properties.form', compact('features'));
    }

    public function store(AddPropertyRequest $request)
    {
        $this->propertyService->createProperty($request);
        return redirect()->back()->with('success', 'Property added successfully');
    }

    public function uploadPropertyImage(PropertyImageRequest $request)
    {
        $imageIds = $this->propertyService->savePropertyImages($request->file('file'));

        return response()->json(['imageIds' => $imageIds]);
    }

    public function getUserProperties()
    {
        $data = $this->propertyService->getUserProperties();
        return view('user.properties', $data);
    }

    public function show(string $id)
    {
        $data = $this->propertyService->getProperty($id);
        return view('properties.show', $data);
    }

    public function edit(string $id)
    {
        $data = $this->propertyService->getPropertyForEditing($id);
        return view('properties.form', $data);
    }

    public function update(AddPropertyRequest $request, string $id)
    {
        return $this->propertyService->updateProperty($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->propertyService->deleteProperty($id);
    }

    public function search(SearchPropertyRequest $request)
    {
        ['properties' => $properties, 'statuses' => $statuses] = $this->propertyService->searchProperties($request);
        $allFeatures = Feature::all();
        return view('search', compact('properties', 'statuses', 'allFeatures'));
    }
}
