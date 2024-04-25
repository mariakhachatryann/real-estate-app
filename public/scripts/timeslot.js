$(".time-slot").each(function() {
    var timeSlot = $(this);
    $(this).find('input').on('change',function() {
        var timeSlotVal = timeSlot.find('strong').text();

        $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
        $('.panel-dropdown').removeClass('active');
    });
});
