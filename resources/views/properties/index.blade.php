<x-layout>
    <div class="parallax" style="background-image: url('images/home-parallax.jpg'); background-size: cover">
        <div class="parallax-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-search-container">
                            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                            <h2>Find Your Dream Home</h2>
                            <form class="main-search-form">
                                <div class="search-type">
                                    <label class="active"><input class="first-tab" name="tab" checked="checked"
                                                                 type="radio">Any Status</label>
                                    <label><input name="tab" type="radio">For Sale</label>
                                    <label><input name="tab" type="radio">For Rent</label>
                                    <div class="search-type-arrow"></div>
                                </div>
                                <div class="main-search-box">
                                    <div class="main-search-input larger-input">
                                        <input type="text" class="ico-01" id="autocomplete-input"
                                               placeholder="Enter address e.g. street, city and state or zip" value=""/>
                                        <button class="button">Search</button>
                                    </div>
                                    <div class="row with-forms">
                                        <div class="col-md-4">
                                            <select data-placeholder="Any Type" class="chosen-select-no-single">
                                                <option>Any Type</option>
                                                <option>Apartments</option>
                                                <option>Houses</option>
                                                <option>Commercial</option>
                                                <option>Garages</option>
                                                <option>Lots</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="select-input">
                                                <input type="text" placeholder="Min Price" data-unit="USD">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="select-input">
                                                <input type="text" placeholder="Max Price" data-unit="USD">
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="more-search-options-trigger" data-open-title="More Options"
                                       data-close-title="Less Options"></a>
                                    <div class="more-search-options">
                                        <div class="more-search-options-container">
                                            <div class="row with-forms">
                                                <div class="col-md-6">
                                                    <div class="select-input">
                                                        <input type="text" placeholder="Min Area" data-unit="Sq Ft">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="select-input">
                                                        <input type="text" placeholder="Max Area" data-unit="Sq Ft">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row with-forms">
                                                <div class="col-md-6">
                                                    <select data-placeholder="Beds" class="chosen-select-no-single">
                                                        <option label="blank"></option>
                                                        <option>Beds (Any)</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select data-placeholder="Baths" class="chosen-select-no-single">
                                                        <option label="blank"></option>
                                                        <option>Baths (Any)</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="checkboxes in-row">
                                                <input id="check-2" type="checkbox" name="check">
                                                <label for="check-2">Air Conditioning</label>

                                                <input id="check-3" type="checkbox" name="check">
                                                <label for="check-3">Swimming Pool</label>

                                                <input id="check-4" type="checkbox" name="check">
                                                <label for="check-4">Central Heating</label>

                                                <input id="check-5" type="checkbox" name="check">
                                                <label for="check-5">Laundry Room</label>

                                                <input id="check-6" type="checkbox" name="check">
                                                <label for="check-6">Gym</label>

                                                <input id="check-7" type="checkbox" name="check">
                                                <label for="check-7">Alarm</label>

                                                <input id="check-8" type="checkbox" name="check">
                                                <label for="check-8">Window Covering</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="headline margin-bottom-25 margin-top-65">Newly Added</h3>
            </div>
            <div class="col-md-12">
                <div class="carousel">
                    @foreach($properties as $property)
                        <div class="carousel-item">
                            <div class="listing-item">
                                <a href="{{ route('properties.show', $property->id) }}" class="listing-img-container">
                                    <div class="listing-badges">
                                        <span class="featured">Featured</span>
                                        <span>For {{ $statuses[$property->status] }}</span>
                                    </div>
                                    <div class="listing-img-content">
                                        <span class="listing-price">${{ number_format($property->price) }} <i>$520 / sq ft</i></span>
                                        @auth('user')
                                            <span class="like-icon with-tip{{ in_array($property->id, $favoritePropertyIds) ? ' liked' : '' }}" data-tip-content="Add to Bookmarks" onclick="addToFavorites({{ $property->id }}, this)" id="fav{{ $property->id }}"></span>
                                            <span class="compare-button with-tip" data-tip-content="Add to Compare"></span>
                                        @endauth
                                    </div>
                                    <div class="listing-carousel">
                                        @foreach( $property->images as $img )
                                            <div><img src="{{ asset('storage/' . $img->path) }}" alt="Property Image"></div>
                                        @endforeach
                                    </div>
                                </a>
                                <div class="listing-content">
                                    <div class="listing-title">
                                        <h4><a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a></h4>
                                        <a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom"
                                           class="listing-address popup-gmaps">
                                            <i class="fa fa-map-marker"></i>
                                            {{ $property->address->address }}
                                        </a>
                                    </div>
                                    <ul class="listing-features">
                                        <li>Area <span>{{ $property->area }} sq ft</span></li>
                                        <li>Bedrooms <span>{{ $property->bedrooms }}</span></li>
                                        <li>Bathrooms <span>{{ $property->bathrooms }}</span></li>
                                    </ul>
                                    <div class="listing-footer">
                                        <a href="#"><i class="fa fa-user"></i> {{ $property->creator->username }}</a>
                                        <span><i class="fa fa-calendar-o"></i> {{ $property->created_at_ago }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <section class="fullwidth margin-top-105" data-background-color="#f7f7f7">

        <!-- Box Headline -->
        <h3 class="headline-box">What are you looking for?</h3>

        <!-- Content -->
        <div class="container">
            <div class="row">

                <div class="col-md-3 col-sm-6">
                    <!-- Icon Box -->
                    <div class="icon-box-1">

                        <div class="icon-container">
                            <i class="im im-icon-Office"></i>
                            <div class="icon-links">
                                <a href="listings-grid-standard-with-sidebar.html">For Sale</a>
                                <a href="listings-grid-standard-with-sidebar.html">For Rent</a>
                            </div>
                        </div>

                        <h3>Apartments</h3>
                        <p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel
                            felis.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <!-- Icon Box -->
                    <div class="icon-box-1">

                        <div class="icon-container">
                            <i class="im im-icon-Home-2"></i>
                            <div class="icon-links">
                                <a href="listings-grid-standard-with-sidebar.html">For Sale</a>
                                <a href="listings-grid-standard-with-sidebar.html">For Rent</a>
                            </div>
                        </div>

                        <h3>Houses</h3>
                        <p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel
                            felis.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <!-- Icon Box -->
                    <div class="icon-box-1">

                        <div class="icon-container">
                            <i class="im im-icon-Car-3"></i>
                            <div class="icon-links">
                                <a href="listings-grid-standard-with-sidebar.html">For Sale</a>
                                <a href="listings-grid-standard-with-sidebar.html">For Rent</a>
                            </div>
                        </div>

                        <h3>Garages</h3>
                        <p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel
                            felis.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <!-- Icon Box -->
                    <div class="icon-box-1">

                        <div class="icon-container">
                            <i class="im im-icon-Clothing-Store"></i>
                            <div class="icon-links">
                                <a href="listings-grid-standard-with-sidebar.html">For Sale</a>
                                <a href="listings-grid-standard-with-sidebar.html">For Rent</a>
                            </div>
                        </div>

                        <h3>Commercial</h3>
                        <p>Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim donec vel lectus vel
                            felis.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-35 margin-top-10">Most Popular Places <span>Properties In Most Popular Places</span>
                </h3>
            </div>

            <div class="col-md-4">

                <!-- Image Box -->
                <a href="listings-list-with-sidebar.html" class="img-box"
                   style="background-image: url('images/popular-location-01.jpg'); background-size: cover;">

                    <!-- Badge -->
                    <div class="listing-badges">
                        <span class="featured">Featured</span>
                    </div>

                    <div class="img-box-content visible">
                        <h4>New York </h4>
                        <span>14 Properties</span>
                    </div>
                </a>

            </div>

            <div class="col-md-8">

                <!-- Image Box -->
                <a href="listings-list-with-sidebar.html" class="img-box"
                   style="background-image: url('images/popular-location-02.jpg'); background-size: cover;">
                    <div class="img-box-content visible">
                        <h4>Los Angeles</h4>
                        <span>24 Properties</span>
                    </div>
                </a>

            </div>

            <div class="col-md-8">

                <!-- Image Box -->
                <a href="listings-list-with-sidebar.html" class="img-box"
                   style="background-image: url('images/popular-location-03.jpg'); background-size: cover;">
                    <div class="img-box-content visible">
                        <h4>San Francisco </h4>
                        <span>12 Properties</span>
                    </div>
                </a>

            </div>

            <div class="col-md-4">

                <!-- Image Box -->
                <a href="listings-list-with-sidebar.html" class="img-box"
                   style="background-image: url('images/popular-location-04.jpg'); background-size: cover;">
                    <div class="img-box-content visible">
                        <h4>Miami</h4>
                        <span>9 Properties</span>
                    </div>
                </a>

            </div>

        </div>
    </div>
    <section class="fullwidth margin-top-95 margin-bottom-0">

        <!-- Box Headline -->
        <h3 class="headline-box">Articles & Tips</h3>

        <div class="container">
            <div class="row">

                <div class="col-md-4">

                    <!-- Blog Post -->
                    <div class="blog-post">

                        <!-- Img -->
                        <a href="blog-post.html" class="post-img">
                            <img src="images/blog-post-01.jpg" alt="">
                        </a>

                        <!-- Content -->
                        <div class="post-content">
                            <h3><a href="#">8 Tips to Help You Finding New Home</a></h3>
                            <p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc,
                                rutrum in malesuada vitae. </p>

                            <a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>

                    </div>
                    <!-- Blog Post / End -->

                </div>

                <div class="col-md-4">

                    <!-- Blog Post -->
                    <div class="blog-post">

                        <!-- Img -->
                        <a href="blog-post.html" class="post-img">
                            <img src="images/blog-post-02.jpg" alt="">
                        </a>

                        <!-- Content -->
                        <div class="post-content">
                            <h3><a href="#">Bedroom Colors You'll Never Regret</a></h3>
                            <p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc,
                                rutrum in malesuada vitae. </p>

                            <a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>

                    </div>
                    <!-- Blog Post / End -->

                </div>

                <div class="col-md-4">

                    <!-- Blog Post -->
                    <div class="blog-post">

                        <!-- Img -->
                        <a href="blog-post.html" class="post-img">
                            <img src="images/blog-post-03.jpg" alt="">
                        </a>

                        <!-- Content -->
                        <div class="post-content">
                            <h3><a href="#">What to Do a Year Before Buying Apartment</a></h3>
                            <p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc,
                                rutrum in malesuada vitae. </p>

                            <a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <a href="listings-half-map-grid-standard.html" class="flip-banner parallax"
       data-background="images/flip-banner-bg.jpg" data-color="#274abb" data-color-opacity="0.9" data-img-width="2500"
       data-img-height="1600">
        <div class="flip-banner-content">
            <h2 class="flip-visible">We help people and homes find each other</h2>
            <h2 class="flip-hidden">Browse Properties <i class="sl sl-icon-arrow-right"></i></h2>
        </div>
    </a>
</x-layout>
<script src="{{ asset('scripts/fav.js') }}"></script>
