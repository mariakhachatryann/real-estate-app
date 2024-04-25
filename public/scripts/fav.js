function add(propertyId, csrfToken) {
    var btn = $("#fav" + propertyId);

    $.ajax({
        url: '/my-favorites',
        method: 'POST',
        data: {
            propertyId: propertyId,
            _token: csrfToken
        },
        success: function(response) {
            console.log('Property added to favorites successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error adding property to favorites:', error);
        }
    });
}

function remove(propertyId, csrfToken) {
    var btn = $("#fav" + propertyId);

    $.ajax({
        url: '/my-favorites/' + propertyId,
        method: 'DELETE',
        data: {
            _token: csrfToken
        },
        success: function(response) {
            console.log('Property removed from favorites successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error removing property from favorites:', error);
        }
    });
}

function addToFavorites(propertyId, buttonElement) {
    var favoriteButton = $(buttonElement);
    var csrfToken = $('#csrf-token').val();

    if (!favoriteButton.hasClass('liked')) {
        add(propertyId, csrfToken)
    } else {
        remove(propertyId, csrfToken)
    }
}
