<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPropertyRequest;
use App\Http\Requests\PropertyImageRequest;
use App\Http\Requests\SearchPropertyRequest;
use App\Models\Feature;
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
        $properties = $this->propertyService->getUserProperties();
        return view('user.properties', compact('properties'));
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
        $this->propertyService->updateProperty($request, $id);
        return redirect()->back()->with('success', 'Property updated successfully');
    }

    public function destroy(string $id)
    {
        $this->propertyService->deleteProperty($id);
        return redirect()->route('myProperties')->with('success', 'Property deleted successfully');
    }

    public function search(SearchPropertyRequest $request)
    {
        $properties = $this->propertyService->searchProperties($request);
        $allFeatures = Feature::all();
        return view('search', compact('properties', 'allFeatures'));
    }
}
