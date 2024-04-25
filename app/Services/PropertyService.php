<?php

namespace App\Services;
use App\Http\Requests\AddPropertyRequest;
use App\Http\Requests\SearchPropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyAddress;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserFavorites;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Illuminate\Support\Str;
class PropertyService
{

    public function getIndexData(): array
    {
        $user = Auth::guard('user')->user();
        $properties = Property::with('images', 'address')
            ->latest()
            ->take(10)
            ->get();

        $favoritePropertyIds = [];
        $comparePropertyIds = [];

        if (Auth::guard('user')->user()) {
            $favoritePropertyIds = $user->favorites()->pluck('property_id')->all();
            $comparePropertyIds = $user->compare()->pluck('property_id')->all();
        }

        return compact('properties', 'favoritePropertyIds', 'comparePropertyIds');
    }

    public function createProperty(AddPropertyRequest $request): void
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

            Mail::to($user->email)->queue(new UserMail($user, $randomPassword));
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
        PropertyImage::whereIn('id', $imgIds)->whereNull('property_id')->update(['property_id' => $property->id]);
    }

    public function savePropertyImages($files): array
    {
        $imageIds = [];

        foreach ($files as $file) {
            $path = $file->store('uploads', 'public');
            $image = new PropertyImage();
            $image->property_id = null;
            $image->path = $path;
            $image->save();

            $imageIds[] = $image->id;
        }

        return $imageIds;
    }

    public function getUserProperties()
    {
        $user = Auth::guard('user')->user();
        return $user->properties()->get();
    }

    public function getProperty(string $id): array
    {
        $property = Property::findOrFail($id);
        $properties = Property::limit(5)->get();

        $favoritePropertyIds = [];

        if (Auth::guard('user')->user()) {
            $favoritePropertyIds = UserFavorites::where('user_id', Auth::guard('user')->user()->id)
                ->pluck('property_id')
                ->all();
        }

        $similarProperties = Property::where(function ($query) use ($property) {
            $query->where('type', $property->type)
                ->orWhereHas('features', function ($query) use ($property) {
                    $query->whereIn('feature_id', $property->features()->pluck('id'));
                });
        })
            ->where('id', '!=', $property->id)
            ->get();
        return compact('property', 'favoritePropertyIds', 'similarProperties', 'properties');
    }

    public function getPropertyForEditing(string $id): array
    {
        $property = Auth::guard('user')->user()->properties()->where('id', $id)->first();
        $features = Feature::all();
        $imageIds = implode(',', $property->images->pluck('id')->toArray());

        return compact('property', 'features', 'imageIds');
    }

    public function updateProperty(AddPropertyRequest $request, string $id): void
    {
        $property = Auth::guard('user')->user()->properties()->where('id', $id)->first();
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
            PropertyImage::whereIn('id', $imgIds)->whereNull('property_id')->update(['property_id' => $property->id]);
        }

        $property->save();
    }

    public function deleteProperty(string $id): void
    {
        $property = Auth::guard('user')->user()->properties()->where('id', $id)->first();

        if ($property->address) {
            $property->address->delete();
        }

        $property->features()->detach();
        $property->images()->delete();
        $property->delete();
    }

    public function searchProperties(SearchPropertyRequest $request)
    {
        $properties = Property::with('images', 'address')
            ->latest()
            ->take(10);

        if ($request->isMethod('post')) {
            $properties->where(function ($query) use ($request) {
                if ($request->status != -1) {
                    $query->where('status', $request->status);
                }
                if ($request->type != -1) {
                    $query->where('type', $request->type);
                }
                if (!empty($request->minArea)) {
                    $query->where('area', '>=', $request->minArea);
                }
                if (!empty($request->maxArea)) {
                    $query->where('area', '<=', $request->maxArea);
                }
                if (!empty($request->minPrice)) {
                    $query->where('price', '>=', $request->minPrice);
                }
                if (!empty($request->maxPrice)) {
                    $query->where('price', '<=', $request->maxPrice);
                }
                if (!empty($request->age)) {
                    $query->where('building_age', '<=', $request->age);
                }
                if (!empty($request->rooms)) {
                    $query->where('rooms', '=', $request->rooms);
                }
                if (!empty($request->beds)) {
                    $query->where('bedrooms', '=', $request->beds);
                }
                if (!empty($request->baths)) {
                    $query->where('bathrooms', '=', $request->baths);
                }
            });

            $address = $request->address;
            $features = $request->features;

            if (!empty($address)) {
                $properties->whereHas('address', function ($query) use ($address) {
                    $query->where('address', 'like', '%' . $address . '%');
                });
            }

            if (!empty($features)) {
                $properties->whereHas('features', function ($query) use ($features) {
                    $query->whereIn('id', $features);
                });
            }
        }

        return $properties->paginate(10);
    }
}
