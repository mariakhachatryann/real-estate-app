<x-layout>
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-12">
                <form
                    action="{{ isset($property) ? route('properties.update', $property->id) : route('properties.store') }}"
                    method="post" enctype="multipart/form-data" class="submit-page">
                    @if(isset($property))
                        @method('PUT')
                    @endif
                    @csrf

                    <div class="notification notice large margin-bottom-55">
                        <h4>Don't Have an Account?</h4>
                        <p>If you don't have an account you can create one by entering your email address in contact
                            details section. A password will be automatically emailed to you.</p>
                    </div>

                    <!-- Section -->
                    <h3>Basic Information</h3>
                    <div class="submit-section">

                        <!-- Title -->
                        <div class="form">
                            <h5>Property Title <i class="tip"
                                                  data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i>
                            </h5>
                            <input name="title" class="search-field" type="text" value="{{ $property->title ?? '' }}"/>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Status -->
                            <div class="col-md-6">
                                <h5>Status</h5>
                                <select class="chosen-select-no-single" name="status">
                                    <option value="" disabled selected>Select Listing Type</option>
                                    <option
                                        value="0" {{ isset($property) && $property->status == 0 ? 'selected' : '' }}>For
                                        Sale
                                    </option>
                                    <option
                                        value="1" {{ isset($property) && $property->status == 1 ? 'selected' : '' }}>For
                                        Rent
                                    </option>
                                </select>
                            </div>

                            <!-- Type -->
                            <div class="col-md-6">
                                <h5>Type</h5>
                                <select name="type" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    <option value="0" {{ isset($property) && $property->type == 0 ? 'selected' : '' }}>
                                        Apartment
                                    </option>
                                    <option value="1" {{ isset($property) && $property->type == 1 ? 'selected' : '' }}>
                                        House
                                    </option>
                                    <option value="2" {{ isset($property) && $property->type == 2 ? 'selected' : '' }}>
                                        Commercial
                                    </option>
                                    <option value="3" {{ isset($property) && $property->type == 3 ? 'selected' : '' }}>
                                        Garage
                                    </option>
                                    <option value="4" {{ isset($property) && $property->type == 4 ? 'selected' : '' }}>
                                        Lot
                                    </option>
                                </select>

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
                                </div>
                            </div>

                            <!-- Area -->
                            <div class="col-md-4">
                                <h5>Area</h5>
                                <div class="select-input disabled-first-option">
                                    <input name="area" type="text" value="{{ $property->area ?? '' }}"
                                           data-unit="Sq Ft">
                                </div>
                            </div>

                            <!-- Rooms -->
                            <div class="col-md-4">
                                <h5>Rooms</h5>
                                <select name="rooms" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    <option value="1" {{ isset($property) && $property->rooms == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option value="2" {{ isset($property) && $property->rooms == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option value="3" {{ isset($property) && $property->rooms == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option value="4" {{ isset($property) && $property->rooms == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option value="5" {{ isset($property) && $property->rooms == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
                                    <option
                                        value="-1" {{ isset($property) && $property->rooms == -1 ? 'selected' : '' }}>
                                        More than 5
                                    </option>
                                </select>

                            </div>

                        </div>
                        <!-- Row / End -->

                    </div>
                    <!-- Section / End -->


                    <!-- Section -->
                    <h3>Gallery</h3>
                    <div class="submit-section dropzone" id="galleryDropzone" action="{{ route('fileUpload') }}"
                         data-dropzone>
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                        @if(isset($property))
                            @foreach($property->images as $image)
                                <div class="dz-preview dz-image-preview">
                                    <div class="dz-image">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Uploaded Image"
                                             class="dz-image">
                                    </div>
                                    <button class="dz-remove" data-image-id="{{ $image->id }}">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <input id="images_ids" type="hidden" name="imageIds">
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
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>City</h5>
                                <input value="{{ $property->address->city ?? '' }}" name="city" type="text">
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>State</h5>
                                <input value="{{ $property->address->state ?? '' }}" name="state" type="text">
                            </div>

                            <!-- Zip-Code -->
                            <div class="col-md-6">
                                <h5>Zip-Code</h5>
                                <input value="{{ $property->address->zip_code ?? '' }}" name="zip_code" type="text">
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
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Age of Home -->
                            <div class="col-md-4">
                                <h5>Building Age <span>(optional)</span></h5>
                                <select name="building_age" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    <option
                                        value="1" {{ isset($property) && $property->building_age == 1 ? 'selected' : '' }}>
                                        0 - 1 Years
                                    </option>
                                    <option
                                        value="5" {{ isset($property) && $property->building_age == 5 ? 'selected' : '' }}>
                                        0 - 5 Years
                                    </option>
                                    <option
                                        value="10" {{ isset($property) && $property->building_age == 10 ? 'selected' : '' }}>
                                        0 - 10 Years
                                    </option>
                                    <option
                                        value="20" {{ isset($property) && $property->building_age == 20 ? 'selected' : '' }}>
                                        0 - 20 Years
                                    </option>
                                    <option
                                        value="50" {{ isset($property) && $property->building_age == 50 ? 'selected' : '' }}>
                                        0 - 50 Years
                                    </option>
                                    <option
                                        value="51" {{ isset($property) && $property->building_age == 51 ? 'selected' : '' }}>
                                        50 + Years
                                    </option>
                                </select>
                            </div>

                            <!-- Beds -->
                            <div class="col-md-4">
                                <h5>Bedrooms <span>(optional)</span></h5>
                                <select name="bedrooms" class="chosen-select-no-single">
                                    <option label="blank"></option>
                                    <option
                                        value="1" {{ isset($property) && $property->bedrooms == 1 ? 'selected' : '' }}>1
                                    </option>
                                    <option
                                        value="2" {{ isset($property) && $property->bedrooms == 2 ? 'selected' : '' }}>2
                                    </option>
                                    <option
                                        value="3" {{ isset($property) && $property->bedrooms == 3 ? 'selected' : '' }}>3
                                    </option>
                                    <option
                                        value="4" {{ isset($property) && $property->bedrooms == 4 ? 'selected' : '' }}>4
                                    </option>
                                    <option
                                        value="5" {{ isset($property) && $property->bedrooms == 5 ? 'selected' : '' }}>5
                                    </option>
                                </select>
                            </div>

                            <!-- Baths -->
                            <div class="col-md-4">
                                <h5>Bathrooms <span>(optional)</span></h5>
                                <select name="bathrooms" class="chosen-select-no-single">
                                    <option value="" label="blank"></option>
                                    <option
                                        value="1" {{ isset($property) && $property->bathrooms == 1 ? 'selected' : '' }}>
                                        1
                                    </option>
                                    <option
                                        value="2" {{ isset($property) && $property->bathrooms == 2 ? 'selected' : '' }}>
                                        2
                                    </option>
                                    <option
                                        value="3" {{ isset($property) && $property->bathrooms == 3 ? 'selected' : '' }}>
                                        3
                                    </option>
                                    <option
                                        value="4" {{ isset($property) && $property->bathrooms == 4 ? 'selected' : '' }}>
                                        4
                                    </option>
                                    <option
                                        value="5" {{ isset($property) && $property->bathrooms == 5 ? 'selected' : '' }}>
                                        5
                                    </option>
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
                                    <a id={{$feature->id}} class="edit-feature" style="margin-right: 10px; color: green; cursor: pointer"><i class="fa fa-pencil"></i>
                                        Edit</a>
                                    <a class="delete-feature" style="color: red; cursor: pointer;"><i class="fa fa-remove"></i> Delete</a>

                                    <input id="{{$feature->id}}" class="edit-input" type="text" style="display: none">
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                        @auth('admin')
                            <div class="form-group">
                                <label for="newFeature">New Feature</label>
                                <input type="text" class="form-control" id="newFeature" placeholder="Enter new feature name">
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".edit-feature").on("click", function () {
                let checkbox = $(this).prev();
                let input = $(this).next().next();
                let originalFeatureName = checkbox.text();
                let featureId = checkbox[0].htmlFor;

                checkbox.css("display", "none");
                input.css("display", "block");
                input.val(originalFeatureName);
                $(this).html("<i class='fa fa-save'></i> Save");

                // Save action
                $(this).off("click").on("click", function () {
                    let newFeatureName = input.val();

                    $.ajax({
                        url: "/features/" + featureId,
                        method: "PUT",
                        data: {
                            name: newFeatureName,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            checkbox.text(newFeatureName);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });

                    input.css("display", "none");
                    checkbox.css("display", "inline-block");
                    $(this).html("<i class='fa fa-pencil'></i> Edit");
                });
            });

            $(".delete-feature").on("click", function () {
                let featureId = $(this).prev().prev()[0].htmlFor;
                $.ajax({
                    url: "/features/" + featureId,
                    method: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $(this).parent().remove();
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $("#addFeatureBtn").click(function (e) {
                var newFeatureName = $("#newFeature").val();
                e.preventDefault();
                $.ajax({
                    url: "{{ route('features.store') }}",
                    type: 'POST',
                    data: {
                        name: newFeatureName,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        var featureId = response.id;
                        var featureName = response.name;
                        $(".checkboxes").append('<div class="feature-item">' +
                            '<input class="feature-checkbox" id="' + featureId + '" type="checkbox" name="features[]" value="' + featureId + '">' +
                            '<label for="' + featureId + '">' + featureName + '</label>' +
                            '</div>');
                        $("#newFeature").val('');
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</x-layout>


