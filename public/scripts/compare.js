function compare(propertyId, pathCheck) {
    var csrfToken = $('#csrf-token').val();
    var imagePath = (pathCheck) ? '../storage/' : 'storage/';
    var compText = $('.empty-compare');

    $.ajax({
        url: '/compare',
        method: 'POST',
        data: {
            propertyId: propertyId,
            _token: csrfToken
        },
        success: function(response) {
            console.log(response);
            compText.remove();
            var newPropertyHtml = `
                        <div class="listing-item compact">
                            <a  class="listing-img-container">
                                <div class="remove-from-compare"><i class="fa fa-close"></i></div>
                                <div class="listing-badges">
                                    <span>For Sale</span>
                                </div>
                                <div class="listing-img-content">
                                    <span class="listing-compact-title">${response.property.title} <i>$${response.property.price}</i></span>
                                </div>
                                <img src="${imagePath}${response.property.images[0].path}" alt="">
                            </a>
                        </div>
                    `;

            $('#compareParent').append(newPropertyHtml);
        },
        error: function(xhr, status, error) {
            console.error('Error adding property to compare:', error);
        }
    });
}

$(document).ready(function() {
    $('.remove-from-compare').on('click', function() {
        $(this).parent().next().submit();
        console.log($(this).parent().next())
    });
});
