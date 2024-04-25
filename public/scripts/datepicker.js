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
