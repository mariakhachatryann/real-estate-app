function compare(propertyId, pathCheck) {
    var csrfToken = $('#csrf-token').val();
    var imagePath = (pathCheck) ? '../storage/' : 'storage/';

    $.ajax({
        url: '/compare',
        method: 'POST',
        data: {
            propertyId: propertyId,
            _token: csrfToken
        },
        success: function(response) {
            console.log(response);
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
