<x-layout>

        <!-- Titlebar
        ================================================== -->
        <div id="titlebar" class="property-titlebar margin-bottom-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <a href="/properties" class="back-to-listings"></a>
                        <div class="property-title">
                            <h2>{{ $property->title }}<span class="property-badge">For {{ $statuses[$property->status] }}</span></h2>
                            <span>
						<div class="listing-address">
							<i class="fa fa-map-marker"></i>
                            {{ $property->address->address }}
						</div>
					</span>
                        </div>

                        <div class="property-pricing">
                            <div class="property-price">${{ number_format($property->price) }}</div>
                            <div class="sub-price">$770 / sq ft</div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <!-- Content
        ================================================== -->
        <div class="container">
            <div class="row margin-bottom-50">
                <div class="col-md-12">

                    <!-- Slider -->
                    <div class="property-slider default">
                        @foreach($property->images as $img)
                            <a href="{{ asset('storage/' . $img->path) }}" data-background-image="{{ asset('storage/' . $img->path) }}" class="item mfp-gallery"></a>
                        @endforeach
                    </div>

                    <!-- Slider Thumbs -->
                    <div class="property-slider-nav">
                        @foreach($property->images as $img)
                            <div class="item"><img src="{{ asset('storage/' . $img->path) }}" alt=""></div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">

                <!-- Property Description -->
                <div class="col-lg-8 col-md-7 sp-content">
                    <div class="property-description">

                        <!-- Main Features -->
                        <ul class="property-main-features">
                            <li>Area <span>{{ $property->area }}</span></li>
                            <li>Rooms <span>{{ $property->rooms == "-1" ? '5+' : $property->rooms}}</span></li>
                            <li>Bedrooms <span>{{ $property->bedrooms }}</span></li>
                            <li>Bathrooms <span>{{ $property->bathrooms }}</span></li>
                        </ul>


                        <!-- Description -->
                        <h3 class="desc-headline">Description</h3>
                        <div class="show-more">
                            {{ $property->description }}

                            <a href="#" class="show-more-button">Show More <i class="fa fa-angle-down"></i></a>
                        </div>

                        <!-- Details -->
                        <h3 class="desc-headline">Details</h3>
                        <ul class="property-features margin-top-0">
                            <li>Building Age: <span>{{ $property->building_age }} Years</span></li>
                        </ul>


                        <!-- Features -->
                        <h3 class="desc-headline">Features</h3>
                        <ul class="property-features checkboxes margin-top-0">
                            @foreach($property->features as $feature)
                                <li>{{ $feature->name }}</li>
                            @endforeach
                        </ul>

                        <!-- Location -->
{{--                        <h3 class="desc-headline no-border" id="location">Location</h3>--}}
{{--                        <div id="propertyMap-container">--}}
{{--                            <div id="propertyMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>--}}
{{--                            <a href="#" id="streetView">Street View</a>--}}
{{--                        </div>--}}


                        <!-- Similar Listings Container -->
                        <h3 class="desc-headline no-border margin-bottom-35 margin-top-60">Similar Properties</h3>

                        <!-- Layout Switcher -->

                        <div class="layout-switcher hidden"><a href="#" class="list"><i class="fa fa-th-list"></i></a></div>
                        <div class="listings-container list-layout">

                            @foreach($similarProperties as $property)
                                <div class="listing-item">

                                    <a href="{{ route('properties.show', $property->id) }}" class="listing-img-container">

                                        <div class="listing-badges">
                                            <span>For {{ $statuses[$property->status] }}</span>
                                        </div>

                                        <div class="listing-img-content">
                                            <span class="listing-price">$ {{ $property->price }} <i>monthly</i></span>
                                            <span class="like-icon with-tip{{ in_array($property->id, $favoritePropertyIds) ? ' liked' : '' }}" data-tip-content="Add to Bookmarks" onclick="addToFavorites({{ $property->id }}, this)" id="fav{{ $property->id }}"></span>
                                        </div>

                                        <img src="{{ asset('storage/' . $property->images[0]->path) }}" alt="">

                                    </a>

                                    <div class="listing-content">

                                        <div class="listing-title">
                                            <h4><a href="#">{{ $property->title }}</a></h4>
                                            <a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
                                                <i class="fa fa-map-marker"></i>
                                                {{ $property->address->address }}
                                            </a>

                                            <a href="{{ route('properties.show', $property->id) }}" class="details button border">Details</a>
                                        </div>

                                        <ul class="listing-details">
                                            <li>{{ $property->area }} sq ft</li>
                                            <li>{{ $property->rooms }} Rooms</li>
                                            <li>{{ $property->bathrooms }} Bathrooms</li>
                                            <li>{{ $property->bedrooms }} Bedrooms</li>
                                        </ul>

                                        <div class="listing-footer">
                                            <a href="#"><i class="fa fa-user"></i> {{ $property->creator->username }}</a>
                                            <span><i class="fa fa-calendar-o"></i> 4 days ago</span>
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <!-- Property Description / End -->


                <!-- Sidebar -->
                <div class="col-lg-4 col-md-5 sp-sidebar">
                    <div class="sidebar sticky right">

                        <!-- Widget -->
                        <div class="widget margin-bottom-30">
                            <button class="widget-button with-tip" data-tip-content="Print"><i class="sl sl-icon-printer"></i></button>
                            <button class="widget-button with-tip with-tip{{ in_array($property->id, $favoritePropertyIds) ? ' liked' : '' }}" data-tip-content="Add to Bookmarks" onclick="addToFavorites({{ $property->id }}, this)" id="fav{{ $property->id }}"><i class="fa fa-star-o"></i></button>
                            <button class="widget-button with-tip compare-widget-button" onclick="compare({{ $property->id }}, true)" id="compare{{ $property->id }}" data-tip-content="Add to Compare"><i class="icon-compare"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <!-- Widget / End -->


                        <!-- Booking Widget -->
                        <div class="widget">
                            <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
                                <h3><i class="fa fa-calendar-check-o"></i> Schedule a Tour</h3>
                                <div class="row with-forms  margin-top-0">

                                    <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                                    <div class="col-lg-12">
                                        <input type="text" id="date-picker" placeholder="Date" readonly="readonly">
                                    </div>
                                    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

                                    <!-- Panel Dropdown -->
                                    <div class="col-lg-12">
                                        <div class="panel-dropdown time-slots-dropdown">
                                            <a href="#">Time</a>
                                            <div class="panel-dropdown-content padding-reset">
                                                <div class="panel-dropdown-scrollable">

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-1">
                                                        <label for="time-slot-1">
                                                            <strong>8:30 am - 9:00 am</strong>
                                                            <span>1 slot available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-2">
                                                        <label for="time-slot-2">
                                                            <strong>9:00 am - 9:30 am</strong>
                                                            <span>2 slots available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-3">
                                                        <label for="time-slot-3">
                                                            <strong>9:30 am - 10:00 am</strong>
                                                            <span>1 slots available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-4">
                                                        <label for="time-slot-4">
                                                            <strong>10:00 am - 10:30 am</strong>
                                                            <span>3 slots available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-5">
                                                        <label for="time-slot-5">
                                                            <strong>13:00 pm - 13:30 pm</strong>
                                                            <span>2 slots available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-6">
                                                        <label for="time-slot-6">
                                                            <strong>13:30 pm - 14:00 pm</strong>
                                                            <span>1 slots available</span>
                                                        </label>
                                                    </div>

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <input type="radio" name="time-slot" id="time-slot-7">
                                                        <label for="time-slot-7">
                                                            <strong>14:00 pm - 14:30 pm</strong>
                                                            <span>1 slots available</span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Panel Dropdown / End -->

                                </div>

                                <!-- Book Now -->
                                <a href="#" class="button book-now fullwidth margin-top-5">Send Request</a>
                            </div>

                        </div>
                        <!-- Booking Widget / End -->


                        <!-- Widget -->
                        <div class="widget">

                            <!-- Agent Widget -->
                            <div class="agent-widget">
                                <div class="agent-title">
                                    <div class="agent-photo"><img src="../images/no-image.jpg" alt="" /></div>
                                    <div class="agent-details">
                                        <h4><a href="#">{{ $property->creator->username }}</a></h4>
                                        <span><i class="sl sl-icon-call-in"></i>{{ $property->creator->phone }}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('agentMessage', $property->creator->id) }}" method="post">
                                    @csrf
                                    <input type="text" name="email" placeholder="Your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
                                    <input type="text" name="phone" placeholder="Your Phone">
                                    <textarea name="message">I'm interested in this property [{{ $property->id }}] and I'd like to know more details.</textarea>
                                    <button type="submit" class="button fullwidth margin-top-5">Send Message</button>
                                </form>

                            </div>
                            <!-- Agent Widget / End -->

                        </div>
                        <!-- Widget / End -->


                        <!-- Widget -->
                        <div class="widget">
                            <h3 class="margin-bottom-30 margin-top-30">Mortgage Calculator</h3>

                            <!-- Mortgage Calculator -->
                            <form action="javascript:void(0);" autocomplete="off" class="mortgageCalc" data-calc-currency="USD">
                                <div class="calc-input">
                                    <div class="pick-price tip" data-tip-content="Set This Property Price"></div>
                                    <input type="text" id="amount" name="amount" placeholder="Sale Price" required>
                                    <label for="amount" class="fa fa-usd"></label>
                                </div>

                                <div class="calc-input">
                                    <input type="text" id="downpayment" placeholder="Down Payment">
                                    <label for="downpayment" class="fa fa-usd"></label>
                                </div>

                                <div class="calc-input">
                                    <input type="text" id="years" placeholder="Loan Term (Years)" required>
                                    <label for="years" class="fa fa-calendar-o"></label>
                                </div>

                                <div class="calc-input">
                                    <input type="text" id="interest" placeholder="Interest Rate" required>
                                    <label for="interest" class="fa fa-percent"></label>
                                </div>

                                <button class="button calc-button" formvalidate>Calculate</button>
                                <div class="calc-output-container"><div class="notification success">Monthly Payment: <strong class="calc-output"></strong></div></div>
                            </form>
                            <!-- Mortgage Calculator / End -->

                        </div>
                        <!-- Widget / End -->


                        <!-- Widget -->
                        <div class="widget">
                            <h3 class="margin-bottom-35">Featured Properties</h3>

                            <div class="listing-carousel outer">
                                @foreach($properties as $prop)
                                    <div class="item">
                                        <div class="listing-item compact">
                                            <a href="#" class="listing-img-container">
                                                <div class="listing-badges">
                                                    <span class="featured">Featured</span>
                                                    <span>For {{ $statuses[$prop->status] }}</span>
                                                </div>
                                                <div class="listing-img-content">
                                                    <span class="listing-compact-title">{{ $prop->title }} <i>${{ number_format($prop->price) }}</i></span>
                                                    <ul class="listing-hidden-content">
                                                        <li>Area <span>{{ $prop->area }} sq ft</span></li>
                                                        <li>Rooms <span>{{ $prop->rooms }}</span></li>
                                                        <li>Beds <span>{{ $prop->bedrooms }}</span></li>
                                                        <li>Baths <span>{{ $prop->bathrooms }}</span></li>
                                                    </ul>
                                                </div>

                                                <img src="{{ asset('storage/' . $prop->images[0]->path) }}" alt="">
                                            </a>

                                        </div>
                                    </div>

                                @endforeach

                            </div>

                        </div>
                        <!-- Widget / End -->

                    </div>
                </div>
                <!-- Sidebar / End -->

            </div>
        </div>
</x-layout>
<script src="{{ asset('scripts/fav.js') }}"></script>
<script src="{{ asset('scripts/compare.js') }}"></script>
