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
    {{ $slot }}
    @include('components._footer')

{{--    <script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/chosen.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/owl.carousel.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/rangeSlider.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/sticky-kit.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/slick.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/masonry.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/mmenu.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/tooltips.min.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/custom.js"></script>--}}
{{--    <script type="text/javascript" src="scripts/dropzone.js"></script>--}}

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

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>

    <script>
        function initAutocomplete() {
            var input = document.getElementById('autocomplete-input');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
            });
        }
    </script>
    <script>
        Dropzone.options.galleryDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            init: function() {
                var myDropzone = this;

                document.querySelector(".submitBtn").addEventListener("click", function(e) {
                     e.preventDefault();
                     e.stopPropagation();
                     myDropzone.processQueue();

                });

                this.on("successmultiple", function(files, response) {
                    console.log("Files uploaded successfully:", files);
                    console.log("Server response:", response);

                    $('#images_ids').val(response.imageIds);
                    $(".submit-page").trigger('submit');
                });
            }
        };

    </script>

    <script src="scripts/moment.min.js"></script>
    <script src="scripts/daterangepicker.js"></script>
    <script>
        // Calendar Init
        $(function() {
            $('#date-picker').daterangepicker({
                "opens": "left",
                singleDatePicker: true,

                // Disabling Date Ranges
                isInvalidDate: function(date) {
                    // Disabling Date Range
                    var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
                    var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
                    return date.isAfter(disabled_start) && date.isBefore(disabled_end);

                    // Disabling Single Day
                    // if (date.format('MM/DD/YYYY') == '08/08/2018') {
                    //     return true;
                    // }
                }
            });
        });

        // Calendar animation
        $('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
            $('.daterangepicker').addClass('calendar-animated');
        });
        $('#date-picker').on('show.daterangepicker', function(ev, picker) {
            $('.daterangepicker').addClass('calendar-visible');
            $('.daterangepicker').removeClass('calendar-hidden');
        });
        $('#date-picker').on('hide.daterangepicker', function(ev, picker) {
            $('.daterangepicker').removeClass('calendar-visible');
            $('.daterangepicker').addClass('calendar-hidden');
        });
    </script>


    <!-- Replacing dropdown placeholder with selected time slot -->
    <script>
        $(".time-slot").each(function() {
            var timeSlot = $(this);
            $(this).find('input').on('change',function() {
                var timeSlotVal = timeSlot.find('strong').text();

                $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
                $('.panel-dropdown').removeClass('active');
            });
        });
    </script>
</div>
</body>
