<x-layout>
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Comparing Properties</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Comparing Properties</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="compare-list-container">
                    <ul id="compare-list">

                        <li class="compare-list-properties">
                            <div class="blank-div"></div>
                            @foreach($properties as $property)
                                <div>
                                    <form action="{{ route('removeComparison', $property->property->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="clp-img">
                                            <img src="{{ asset('storage/' . $property->property->images[0]->path) }}" alt="">
{{--                                            <span class="remove-from-compare"><i class="fa fa-close"></i>Remove</span>--}}
                                        </div>

                                        <button type="submit" style="background: none; color: red; border: none"><i class="fa fa-close"></i>Remove</button>
                                        <div class="clp-title">
                                            <h4>{{ $property->property->title }}</h4>
                                            <span>${{ number_format($property->property->price) }}</span>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </li>

                        <li>
                            <div>Area</div>
                            @foreach($properties as $property)
                                <div>{{ $property->property->area }} sq ft</div>
                            @endforeach
                        </li>

                        <li>
                            <div>Rooms</div>
                            @foreach($properties as $property)
                                <div>{{ $property->property->rooms == '-1' ? '5+' :  $property->property->rooms }}</div>
                            @endforeach
                        </li>

                        <li>
                            <div>Bedrooms</div>
                            @foreach($properties as $property)
                                <div>{{ $property->property->bedrooms }}</div>
                            @endforeach
                        </li>

                        <li>
                            <div>Bathrooms</div>
                            @foreach($properties as $property)
                                <div>{{ $property->property->bathrooms }}</div>
                            @endforeach
                        </li>

                        @foreach($features as $feature)
                            <li>
                                <div>{{ $feature->name }}</div>
                                @foreach($properties as $property)
                                    <div>
                                        @if($property->property->features->contains('name', $feature->name))
                                            <span class="available"></span>
                                        @else
                                            <span class="not-available"></span>
                                        @endif
                                    </div>
                                @endforeach
                            </li>
                        @endforeach

                        <li>
                            <div>Building Age</div>
                            @foreach($properties as $property)
                                <div>0-{{ $property->property->building_age }} Years</div>
                            @endforeach
                        </li>

                    </ul>
                </div>
                <!-- Compare List / End -->

            </div>
        </div>
    </div>
</x-layout>
