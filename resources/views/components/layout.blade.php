<!DOCTYPE html>
<head>
    <title>Findeo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
</head>
<body>
<div id="wrapper">
    @include("components._nav")
        @yield('layout')
    @include('components._footer')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>

<script src="{{ asset('scripts/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('scripts/jquery-migrate-3.1.0.min.js') }}"></script>
<script src="{{ asset('scripts/chosen.min.js') }}"></script>
<script src="{{ asset('scripts/magnific-popup.min.js') }}"></script>
<script src="{{ asset('scripts/owl.carousel.min.js') }}"></script>
<script src="{{ asset('scripts/rangeSlider.js') }}"></script>
<script src="{{ asset('scripts/sticky-kit.min.js') }}"></script>
<script src="{{ asset('scripts/slick.min.js') }}"></script>
<script src="{{ asset('scripts/masonry.min.js') }}"></script>
<script src="{{ asset('scripts/mmenu.min.js') }}"></script>
<script src="{{ asset('scripts/tooltips.min.js') }}"></script>
<script src="{{ asset('scripts/custom.js') }}"></script>
<script src="{{ asset('scripts/dropzone.js') }}"></script>
<script src="{{ asset('scripts/dropzOptions.js') }}"></script>
<script src="{{ asset('scripts/datepicker.js') }}"></script>
<script src="{{ asset('scripts/moment.min.js') }}"></script>
<script src="{{ asset('scripts/daterangepicker.js') }}"></script>
<script src="{{ asset('scripts/timeslot.js') }}"></script>
<script src="{{ asset('scripts/autocomplete.js') }}"></script>

@yield('javascript')

</body>
