<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPropertyRequest;
use App\Http\Requests\SearchPropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyAddress;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with('images', 'address')
            ->latest()
            ->take(10)
            ->get();

        $statuses = self::STATUSES;
        return view('properties.index', compact('properties', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::all();
        return view('properties.form', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPropertyRequest $request)
    {
        $property = new Property();
        $user = Auth::guard('user')->user();

        if (!$user) {
            $randomPassword = Str::random(8);

            $user = User::create([
                'username' => $request->user_name,
                'email' => $request->user_email,
                'password' => Hash::make($randomPassword),
            ]);

            Mail::to($user->email)->send(new UserMail($randomPassword));
        }

        $property->fill($request->except(['_token', 'file', 'address', 'city', 'state', 'zip_code', 'features', 'user_name', 'user_email', 'user_phone', 'imageIds']));
        $property->user_id = $user->id;
        $property->save();

        $address = new PropertyAddress();
        $address->fill($request->only(['address', 'city', 'state', 'zip_code']));
        $address->property_id = $property->id;
        $address->save();

        if ($request->has('features')) {
            foreach ($request->features as $featureId) {
                $propertyFeature = new PropertyFeature();
                $propertyFeature->property_id = $property->id;
                $propertyFeature->feature_id = $featureId;
                $propertyFeature->save();
            }
        }

        $imgIds = explode(",", $request->imageIds);
        foreach ($imgIds as $id) {
            $image = PropertyImage::find($id);

            if ($image) {
                $image->update(['property_id' => $property->id]);
            }
        }
        return redirect()->back()->with('success', 'Property added successfully');
    }

    public function uploadPropertyImage(Request $request)
    {
        $imageIds = [];

        foreach ($request->file('file') as $file) {
            $path = $file->store('uploads', 'public');
            $image = new PropertyImage();
            $image->property_id = null;
            $image->path = $path;
            $image->save();

            $imageIds[] = $image->id;
        }

        return response()->json(['imageIds' => $imageIds]);
    }

    public function getUserProperties()
    {
        $properties = Property::where('user_id', Auth::guard('user')->user()->id)->get();
        $statuses = self::STATUSES;
        return view('user.properties', compact('properties', 'statuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::where('id', $id)->first();
        $statuses = self::STATUSES;
        return view('properties.show', compact('property', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::where('id', $id)->first();
        $statuses = self::STATUSES;
        $features = Feature::all();
        return view('properties.form', compact('property', 'features', 'statuses'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::findOrFail($id);
        $property->fill($request->except(['_token', '_method', 'file', 'address', 'city', 'state', 'zip_code', 'features', 'user_name', 'user_email', 'user_phone', 'imageIds']));

        if ($property->address) {
            $property->address->fill($request->only(['address', 'city', 'state', 'zip_code']));
            $property->address->save();
        }

        if ($request->has('features')) {
            $property->features()->sync($request->features);
        }

        if ($request->has('imageIds')) {
            $imgIds = explode(",", $request->imageIds);
            foreach ($imgIds as $id) {
                $image = PropertyImage::find($id);

                if ($image) {
                    $image->update(['property_id' => $property->id]);
                }
            }
        }

        $property->save();

        return redirect()->back()->with('success', 'Property updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);

        if ($property->address) {
            $property->address->delete();
        }

        $property->features()->detach();
        $property->images()->delete();
        $property->delete();

        return redirect()->back()->with('success', 'Property deleted successfully');
    }


    public function search(SearchPropertyRequest $request)
    {
        $properties = Property::with('images', 'address')
            ->latest()
            ->take(10);

        $statuses = self::STATUSES;
        $allFeatures = Feature::all();

        if ($request->isMethod('post')) {
            $status = $request->status;
            $type = $request->type;
            $minArea = $request->min_area;
            $maxArea = $request->max_area;
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $age = $request->age;
            $rooms = $request->rooms;
            $beds = $request->bedrooms;
            $baths = $request->bathrooms;

            $properties->where(function($query) use ($status, $type, $minArea, $maxArea, $minPrice, $maxPrice, $age, $rooms, $beds, $baths) {
                if ($status != -1) {
                    $query->where('status', $status);
                }
                if ($type != -1) {
                    $query->where('type', $type);
                }
                if (!empty($minArea)) {
                    $query->where('area', '>=', $minArea);
                }
                if (!empty($maxArea)) {
                    $query->where('area', '<=', $maxArea);
                }
                if (!empty($minPrice)) {
                    $query->where('price', '>=', $minPrice);
                }
                if (!empty($maxPrice)) {
                    $query->where('price', '<=', $maxPrice);
                }
                if (!empty($age)) {
                    $query->where('building_age', '<=', $age);
                }
                if (!empty($rooms)) {
                    $query->where('rooms', '=', $rooms);
                }
                if (!empty($beds)) {
                    $query->where('bedrooms', '=', $beds);
                }
                if (!empty($baths)) {
                    $query->where('bathrooms', '=', $baths);
                }

            });

            $address = $request->address;
            $features = $request->features;

            if (!empty($address)) {
                $properties->whereHas('address', function($query) use ($address) {
                    $query->where('address', 'like', '%' . $address . '%');
                });
            }

            if (!empty($features)) {
                $properties->whereHas('features', function($query) use ($features) {
                    $query->whereIn('id', $features);
                });
            }

        }

        $properties = $properties->get();
        return view('search', compact('properties', 'statuses', 'allFeatures'));
    }
}
