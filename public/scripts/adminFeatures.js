$(document).ready(function () {
    // Function to get CSRF token
    function getCSRFToken() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    $(".edit-feature").on("click", function () {
        let checkbox = $(this).prev();
        let input = $(this).next().next();
        let originalFeatureName = checkbox.text();
        let featureId = checkbox[0].htmlFor;

        checkbox.css("display", "none");
        input.css("display", "block");
        input.val(originalFeatureName);
        $(this).html("<i class='fa fa-save'></i> Save");

        // Save action
        $(this).off("click").on("click", function () {
            let newFeatureName = input.val();

            $.ajax({
                url: "/features/" + featureId,
                method: "PUT",
                data: {
                    name: newFeatureName,
                    _token: getCSRFToken() // Include CSRF token here
                },
                success: function (response) {
                    checkbox.text(newFeatureName);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

            input.css("display", "none");
            checkbox.css("display", "inline-block");
            $(this).html("<i class='fa fa-pencil'></i> Edit");
        });
    });

    $(".delete-feature").on("click", function () {
        let featureId = $(this).prev().prev()[0].htmlFor;
        $.ajax({
            url: "/features/" + featureId,
            method: "DELETE",
            data: {
                _token: getCSRFToken() // Include CSRF token here
            },
            success: function (response) {
                $(this).parent().remove();
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    $("#addFeatureBtn").click(function (e) {
        var newFeatureName = $("#newFeature").val();
        e.preventDefault();
        $.ajax({
            url: "/features",
            type: 'POST',
            data: {
                name: newFeatureName,
                _token: getCSRFToken() // Include CSRF token here
            },
            success: function (response) {
                var featureId = response.id;
                var featureName = response.name;
                $(".checkboxes").append('<div class="feature-item">' +
                    '<input class="feature-checkbox" id="' + featureId + '" type="checkbox" name="features[]" value="' + featureId + '">' +
                    '<label for="' + featureId + '">' + featureName + '</label>' +
                    '</div>');
                $("#newFeature").val('');
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
