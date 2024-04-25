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
