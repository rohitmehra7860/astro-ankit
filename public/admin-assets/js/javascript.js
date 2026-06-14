$(document).ready(function () {

    // slug maker
    $("#title").on("input", function () {
        let title = $(this).val();
        let slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-'); // Remove multiple hyphens

        $("#slug").val(slug);
    });

    // AOS
    AOS.init();

    //  tinymce 
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'advlist autolink lists link charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
        height: 600
    });



    //  Image Preview 
    $('#image_url').change(function () {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }

        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]); // Convert to base64 string
        }
    });

    // Multiple Image Preview 
    $('#image_url').on('change', function (event) {
        var container = $('#imagePreviewContainer');
        container.html(''); // Clear old previews

        $.each(event.target.files, function (index, file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $('<img>')
                    .attr('src', e.target.result)
                    .addClass('img-thumbnail m-1')
                    .css('width', '100px');
                container.append(img);
            };
            reader.readAsDataURL(file);
        });
    });


    $('#mobile_image_url').change(function () {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview2').attr('src', e.target.result).show();
        }

        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]); // Convert to base64 string
        }
    });

    // Multiple Delete Alert
    $('#multiple-delete').on('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Selected items will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete them!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form manually
            }
        });
    });


    // Delete Alert
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();

        let deleteUrl = $(this).data('url'); // Get URL from data attribute

        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl; // Redirect to delete route
            }
        });
    });





    // When #select-all is clicked
    $('#select-all').on('click', function () {
        // Check or uncheck all checkboxes with class .item-checkbox
        $('.item-checkbox').prop('checked', $(this).prop('checked'));
    });

    // If any .item-checkbox is unchecked, uncheck #select-all
    $('.item-checkbox').on('change', function () {
        // If all checkboxes are checked, check #select-all
        if ($('.item-checkbox:checked').length === $('.item-checkbox').length) {
            $('#select-all').prop('checked', true);
        } else {
            // Otherwise, uncheck #select-all
            $('#select-all').prop('checked', false);
        }
    });


});