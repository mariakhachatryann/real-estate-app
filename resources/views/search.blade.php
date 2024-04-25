@extends('components.layout')
@section('layout')
    <!-- Search
    ================================================== -->
    <section class="search margin-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Title -->
                    <h3 class="search-title">Search</h3>

                    <!-- Form -->
                    <form action="{{ route('search') }}" method="post" class="main-search-box no-shadow">
                        @csrf

                        <!-- Row With Forms -->
                        <div class="row with-forms">

                            <!-- Status -->
                            <div class="col-md-3">
                                <select name="status" data-placeholder="Any Status" class="chosen-select-no-single" >
                                    <option value="-1">Any Status</option>
                                    <option value="0">For Sale</option>
                                    <option value="1">For Rent</option>
                                </select>
                            </div>

                            <!-- Property Type -->
                            <div class="col-md-3">
                                <select name="type" data-placeholder="Any Type" class="chosen-select-no-single" >
                                    <option value="-1">Any Type</option>
                                    <option value="0">Apartments</option>
                                    <option value="1">Houses</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Garages</option>
                                    <option value="4">Lots</option>
                                </select>
                            </div>

                            <!-- Main Search Input -->
                            <div class="col-md-6">
                                <div class="main-search-input">
                                    <input name="address" type="text" placeholder="Enter address e.g. street, city or state" value=""/>
                                    <button type="submit" class="button">Search</button>
                                </div>
                            </div>

                        </div>
                        <!-- Row With Forms / End -->


                        <!-- Row With Forms -->
                        <div class="row with-forms">

                            <!-- Min Price -->
                            <div class="col-md-3">

                                <!-- Select Input -->
                                <div class="select-input disabled-first-option">
                                    <input name="min_area" type="text" placeholder="Min Area" data-unit="Sq Ft">
                                    <select>
                                        <option>Min Area</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                        <option value="700">700</option>
                                        <option value="800">800</option>
                                        <option value="1000">1000</option>
                                        <option value="1500">1500</option>
                                    </select>
                                </div>
                                <!-- Select Input / End -->

                            </div>

                            <!-- Max Price -->
                            <div class="col-md-3">

                                <!-- Select Input -->
                                <div class="select-input disabled-first-option">
                                    <input name="max_area" type="text" placeholder="Max Area" data-unit="Sq Ft">
                                    <select >
                                        <option>Min Area</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                        <option value="700">700</option>
                                        <option value="800">800</option>
                                        <option value="1000">1000</option>
                                        <option value="1500">1500</option>
                                    </select>
                                </div>
                                <!-- Select Input / End -->

                            </div>


                            <!-- Min Price -->
                            <div class="col-md-3">

                                <!-- Select Input -->
                                <div class="select-input disabled-first-option">
                                    <input name="min_price" type="text" placeholder="Min Price" data-unit="USD">
                                    <select>
                                        <option value="">Min Price</option>
                                        <option value="1000">1000</option>
                                        <option value="2000">2000</option>
                                        <option value="3000">3000</option>
                                        <option value="4000">4000</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                                        <option value="15000">15000</option>
                                        <option value="20000">20000</option>
                                        <option value="30000">30000</option>
                                        <option value="40000">40000</option>
                                        <option value="50000">50000</option>
                                        <option value="60000">60000</option>
                                        <option value="70000">70000</option>
                                        <option value="80000">80000</option>
                                        <option value="90000">90000</option>
                                        <option value="100000">100000</option>
                                        <option value="110000">110000</option>
                                        <option value="120000">120000</option>
                                        <option value="130000">130000</option>
                                        <option value="140000">140000</option>
                                        <option value="150000">150000</option>
                                    </select>
                                </div>
                                <!-- Select Input / End -->

                            </div>


                            <!-- Max Price -->
                            <div class="col-md-3">

                                <!-- Select Input -->
                                <div class="select-input disabled-first-option">
                                    <input name="max_price" type="text" placeholder="Max Price" data-unit="USD">
                                    <select>
                                        <option value="">Min Price</option>
                                        <option value="1000">1000</option>
                                        <option value="2000">2000</option>
                                        <option value="3000">3000</option>
                                        <option value="4000">4000</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                                        <option value="15000">15000</option>
                                        <option value="20000">20000</option>
                                        <option value="30000">30000</option>
                                        <option value="40000">40000</option>
                                        <option value="50000">50000</option>
                                        <option value="60000">60000</option>
                                        <option value="70000">70000</option>
                                        <option value="80000">80000</option>
                                        <option value="90000">90000</option>
                                        <option value="100000">100000</option>
                                        <option value="110000">110000</option>
                                        <option value="120000">120000</option>
                                        <option value="130000">130000</option>
                                        <option value="140000">140000</option>
                                        <option value="150000">150000</option>
                                    </select>
                                </div>
                                <!-- Select Input / End -->

                            </div>

                        </div>
                        <!-- Row With Forms / End -->


                        <!-- More Search Options -->
                        <a href="#" class="more-search-options-trigger margin-top-10" data-open-title="More Options" data-close-title="Less Options"></a>

                        <div class="more-search-options relative">
                            <div class="more-search-options-container">

                                <!-- Row With Forms -->
                                <div class="row with-forms">

                                    <!-- Age of Home -->
                                    <div class="col-md-3">
                                        <select name="age" data-placeholder="Age of Home" class="chosen-select-no-single" >
                                            <option label="blank"></option>
                                            <option>Age of Home (Any)</option>
                                            <option value="1">0 - 1 Years</option>
                                            <option value="5">0 - 5 Years</option>
                                            <option value="10">0 - 10 Years</option>
                                            <option value="20">0 - 20 Years</option>
                                            <option value="50">0 - 50 Years</option>
                                            <option value="51">50 + Years</option>
                                        </select>
                                    </div>

                                    <!-- Rooms Area -->
                                    <div class="col-md-3">
                                        <select name="rooms" data-placeholder="Rooms" class="chosen-select-no-single" >
                                            <option label="blank"></option>
                                            <option>Rooms (Any)</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>

                                    <!-- Min Area -->
                                    <div class="col-md-3">
                                        <select name="bedrooms" data-placeholder="Beds" class="chosen-select-no-single" >
                                            <option label="blank"></option>
                                            <option>Beds (Any)</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>

                                    <!-- Max Area -->
                                    <div class="col-md-3">
                                        <select name="bathrooms" data-placeholder="Baths" class="chosen-select-no-single" >
                                            <option label="blank"></option>
                                            <option>Baths (Any)</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- Row With Forms / End -->


                                <!-- Checkboxes -->
                                <div class="checkboxes in-row">
                                    @foreach ($allFeatures as $feature)
                                            <input class="feature-checkbox" id="{{$feature->id}}" type="checkbox"
                                                   name="features[]" value="{{$feature->id}}" data-feature-id="{{$feature->id}}">
                                            <label for="{{$feature->id}}">{{ $feature->name }}</label>
                                    @endforeach

                                </div>
                                <!-- Checkboxes / End -->

                            </div>

                        </div>
                        <!-- More Search Options / End -->


                    </form>
                    <!-- Box / End -->
                </div>
            </div>
        </div>
    </section>



    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="row fullwidth-layout">

            <div class="col-md-12">

                <!-- Sorting / Layout Switcher -->
                <div class="row margin-bottom-15">

                    <div class="col-md-6">
                        <!-- Sort by -->
                        <div class="sort-by">
                            <label>Sort by:</label>
                            <div class="sort-by-select">
                                <select id="sort-properties" data-placeholder="Default order" class="chosen-select-no-single">
                                    <option value="default">Default Order</option>
                                    <option value="price_low_high">Price Low to High</option>
                                    <option value="price_high_low">Price High to Low</option>
                                    <option value="newest">Newest Properties</option>
                                    <option value="oldest">Oldest Properties</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Layout Switcher -->
                        <div class="layout-switcher">
                            <a href="#" class="list"><i class="fa fa-th-list"></i></a>
                            <a href="#" class="grid"><i class="fa fa-th-large"></i></a>
                            <a href="#" class="grid-three"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                </div>


                <!-- Listings -->
                <div class="listings-container list-layout">

                    @foreach($properties as $property)
                        <div class="listing-item">

                            <a href="{{ route('properties.show', $property->id) }}" class="listing-img-container">

                                <div class="listing-badges">
                                    <span class="featured">Featured</span>
                                    <span>For {{ \App\Models\Property::STATUSES[$property->status] }}</span>
                                </div>

                                <div class="listing-img-content">
                                    <span class="listing-price">${{ number_format($property->price) }} <i>$520 / sq ft</i></span>
                                    <span class="like-icon with-tip" data-tip-content="Add to Bookmarks"></span>
                                    <span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
                                </div>

                                <div class="listing-carousel">
                                    @foreach($property->images as $img)
                                        <div><img src="{{ asset('storage/' . $img->path) }}" alt=""></div>
                                    @endforeach
                                </div>
                            </a>

                            <div class="listing-content">

                                <div class="listing-title">
                                    <h4><a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a></h4>
                                    <a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
                                        <i class="fa fa-map-marker"></i>
                                        {{ $property->address->address }}
                                    </a>

                                    <a href="{{ route('properties.show', $property->id) }}" class="details button border">Details</a>
                                </div>

                                <ul class="listing-details">
                                    <li>530 sq ft</li>
                                    <li>{{ $property->bedrooms }} Bedroom</li>
                                    <li>{{ $property->rooms }} Rooms</li>
                                    <li>{{ $property->bathrooms }} Bathroom</li>
                                </ul>

                                <div class="listing-footer">
                                    <a href="#"><i class="fa fa-user"></i> {{ $property->creator->username }}</a>
                                    <span><i class="fa fa-calendar-o"></i> {{ $property->created_at }}</span>
                                </div>

                            </div>

                        </div>

                    @endforeach
                    <!-- Listing Item -->
                    <!-- Listing Item / End -->

                </div>
                <!-- Listings Container / End -->

                <div class="clearfix"></div>
                <!-- Pagination -->
                <div class="pagination-container margin-top-20">
                    <nav class="pagination">
                        <ul>
                            @foreach ($properties->links()->elements[0] as $page => $url)
                                <li><a href="{{ $url }}" class="{{ $page == $properties->currentPage() ? 'current-page' : '' }}">{{ $page }}</a></li>
                            @endforeach

                        </ul>
                    </nav>

                    <nav class="pagination-next-prev">
                        <ul>
                            @if ($properties->previousPageUrl())
                                <li><a href="{{ $properties->previousPageUrl() }}" class="prev">Previous</a></li>
                            @endif

                            @if ($properties->nextPageUrl())
                                <li><a href="{{ $properties->nextPageUrl() }}" class="next">Next</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
