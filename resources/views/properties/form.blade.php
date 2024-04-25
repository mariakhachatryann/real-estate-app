@extends('components.layout')
@section('layout')
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </header>
    <div id="titlebar" class="submit-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><i class="fa fa-plus-circle"></i> {{ isset($property) ? 'Edit' : 'Add' }} Property</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ isset($property) ? route('properties.update', $property->id) : route('properties.store') }}"
                    method="post" enctype="multipart/form-data" class="submit-page">
                    @if(isset($property))
                        @method('PUT')
                    @endif
                    @csrf

                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @guest('user')
                        <div class="notification notice large margin-bottom-55">
                            <h4>Don't Have an Account?</h4>
                            <p>If you don't have an account you can create one by entering your email address in contact
                                details section. A password will be automatically emailed to you.</p>
                        </div>
                    @endguest

                    <!-- Section -->
                    <h3>Basic Information</h3>
                    <div class="submit-section">

                        <!-- Title -->
                        <div class="form">
                            <h5>Property Title <i class="tip" data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i>
                            </h5>
                            <input name="title" class="search-field" type="text" value="{{ $property->title ?? '' }}"/>
                            @error('title')
                                <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Status -->
                            <div class="col-md-6">
                                <h5>Status</h5>
                                <select class="chosen-select-no-single" name="status">
                                    <option value="" disabled selected>Select Listing Type</option>
                                    @foreach(\App\Models\Property::STATUSES as $statusValue => $statusName)
                                        <option
                                            value="{{ $statusValue }}" {{ isset($property) && $property->status == $statusValue ? 'selected' : '' }}>For
                                            {{ $statusName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div class="col-md-6">
                                <h5>Type</h5>
                                <select name="type" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    @foreach(\App\Models\Property::TYPES as $typeValue => $typeName)
                                        <option value="{{ $typeValue }}" {{ isset($property) && $property->type == $typeValue ? 'selected' : '' }}>
                                            {{ $typeName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>
                        <!-- Row / End -->


                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Price -->
                            <div class="col-md-4">
                                <h5>Price <i class="tip"
                                             data-tip-content="Type overall or monthly price if property is for rent"></i>
                                </h5>
                                <div class="select-input disabled-first-option">
                                    <input name="price" value="{{ $property->price ?? '' }}" type="text"
                                           data-unit="USD">
                                    @error('price')
                                        <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Area -->
                            <div class="col-md-4">
                                <h5>Area</h5>
                                <div class="select-input disabled-first-option">
                                    <input name="area" type="text" value="{{ $property->area ?? '' }}"
                                           data-unit="Sq Ft">
                                    @error('area')
                                        <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Rooms -->
                            <div class="col-md-4">
                                <h5>Rooms</h5>
                                <select name="rooms" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    @foreach(\App\Models\Property::ROOMS_LABELS as $roomValue => $roomName)
                                        <option value="{{ $roomValue }}" {{ isset($property) && $property->rooms ==  $roomValue ? 'selected' : '' }}>
                                            {{ $roomName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rooms')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <!-- Row / End -->

                    </div>
                    <!-- Section / End -->


                    <!-- Section -->
                    <h3>Gallery</h3>
                    <div class="submit-section dropzone" id="galleryDropzone" action="{{ route('fileUpload') }}" data-dropzone>
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                        @if(isset($property))
                            @foreach($property->images as $image)
                                <div class="dz-preview dz-image-preview">
                                    <div class="dz-image">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Uploaded Image" class="dz-image">
                                    </div>
                                    <button class="dz-remove" data-image-id="{{ $image->id }}">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('imageIds')
                        <p style="color: red; margin-top: 5px;">Image is required</p>
                    @enderror

                    <input id="images_ids" value="{{ $imageIds ?? null }}" type="hidden" name="imageIds">
                    <!-- Section / End -->

                    <!-- Section -->
                    <h3>Location</h3>
                    <div class="submit-section">

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Address -->
                            <div class="col-md-6">
                                <h5>Address</h5>
                                <input value="{{ $property->address->address ?? '' }}" name="address" type="text">
                                @error('address')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>City</h5>
                                <input value="{{ $property->address->city ?? '' }}" name="city" type="text">
                                @error('city')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>State</h5>
                                <input value="{{ $property->address->state ?? '' }}" name="state" type="text">
                                @error('city')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Zip-Code -->
                            <div class="col-md-6">
                                <h5>Zip-Code</h5>
                                <input value="{{ $property->address->zip_code ?? '' }}" name="zip_code" type="text">
                                @error('zip_code')
                                    <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <!-- Row / End -->

                    </div>
                    <!-- Section / End -->


                    <!-- Section -->
                    <h3>Detailed Information</h3>
                    <div class="submit-section">

                        <!-- Description -->
                        <div class="form">
                            <h5>Description</h5>
                            <textarea name="description" class="WYSIWYG" cols="40" rows="3" id="summary"
                                      spellcheck="true">{{ $property->description ?? '' }}</textarea>
                            @error('description')
                                <p style="color: red; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Age of Home -->
                            <div class="col-md-4">
                                <h5>Building Age <span>(optional)</span></h5>
                                <select name="building_age" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    @foreach(\App\Models\Property::BUILDING_AGE_LABELS as $ageValue => $ageName)
                                        <option
                                            value="{{ $ageValue }}" {{ isset($property) && $property->building_age == $ageValue ? 'selected' : '' }}>
                                            {{ $ageName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Beds -->
                            <div class="col-md-4">
                                <h5>Bedrooms <span>(optional)</span></h5>
                                <select name="bedrooms" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    @foreach(\App\Models\Property::BEDBATH_LABELS as $bedValue )
                                        <option
                                            value="{{ $bedValue }}" {{ isset($property) && $property->bedrooms == $bedValue ? 'selected' : '' }}>
                                            {{ $bedValue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Baths -->
                            <div class="col-md-4">
                                <h5>Bathrooms <span>(optional)</span></h5>
                                <select name="bathrooms" class="chosen-select-no-single">
                                    <option value="" label="blank"></option>
                                    @foreach(\App\Models\Property::BEDBATH_LABELS as $bathValue)
                                        <option
                                            value="{{ $bathValue }}" {{ isset($property) && $property->bathrooms == $bathValue ? 'selected' : '' }}>
                                            {{ $bathValue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <!-- Row / End -->

                        <!-- Checkboxes -->
                        <h5 class="margin-top-30">Other Features <span>(optional)</span></h5>

                        <div class="checkboxes in-row margin-bottom-20">
                            @foreach ($features as $feature)
                                <div class="feature-item">
                                    <input class="feature-checkbox" id="{{$feature->id}}" type="checkbox"
                                           name="features[]" value="{{$feature->id}}" data-feature-id="{{$feature->id}}"
                                        {{ isset($property) && $property->features->contains($feature->id) ? 'checked' : '' }}>

                                    <label for="{{$feature->id}}">{{ $feature->name }}</label>

                                    @auth('admin')
                                        <a id={{$feature->id}} class="edit-feature"
                                           style="margin-right: 10px; color: green; cursor: pointer"><i
                                                class="fa fa-pencil"></i>
                                            Edit</a>
                                        <a class="delete-feature" style="color: red; cursor: pointer;"><i
                                                class="fa fa-remove"></i> Delete</a>

                                        <input id="{{$feature->id}}" class="edit-input" type="text"
                                               style="display: none">
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                        @auth('admin')
                            <div class="form-group">
                                <label for="newFeature">New Feature</label>
                                <input type="text" class="form-control" id="newFeature"
                                       placeholder="Enter new feature name">
                            </div>
                            <button id="addFeatureBtn" class="btn btn-primary">Add Feature</button>
                        @endauth
                        <!-- Checkboxes / End -->
                    </div>
                    <!-- Section / End -->

                    <!-- Section -->
                    <h3>Contact Details</h3>
                    <div class="submit-section">
                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Name -->
                            <div class="col-md-4">
                                <h5>Name</h5>
                                <input type="text" name="user_name"
                                       value="{{ Auth::guard('user')->user()->username ?? '' }}">
                            </div>
                            <!-- Email -->
                            <div class="col-md-4">
                                <h5>E-Mail</h5>
                                <input type="email" name="user_email"
                                       value="{{ Auth::guard('user')->user()->email ?? '' }}">
                            </div>
                            <!-- Phone -->
                            <div class="col-md-4">
                                <h5>Phone <span>(optional)</span></h5>
                                <input type="text" name="user_phone"
                                       value="{{ Auth::guard('user')->user()->phone ?? '' }}">
                            </div>
                        </div>
                        <!-- Row / End -->
                    </div>
                    <!-- Section / End -->
                    <div class="divider"></div>
                    <button type="submit" class="submitBtn button preview margin-top-5">Preview <i
                            class="fa fa-arrow-circle-right"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('scripts/adminFeatures.js') }}"></script>
@endsection
