
//Frontend Wishlist

$(document).ready(function () {
    console.log('Wishlist script loaded');
    console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
    console.log('Wishlist count element exists:', $('#wishlist-count').length > 0);
    console.log('Wishlist total element exists:', $('#wishlist-total').length > 0);

    // Only load wishlist if user is authenticated
    // Check if wishlist elements exist (means user is logged in)
    if ($('#wishlist-count').length > 0 || $('#wishlist-total').length > 0) {
        console.log('User is logged in, loading wishlist...');
        getWishlist();
    } else {
        console.log('User is not logged in, skipping wishlist load');
    }
});


$(document).on('click', '.wishlist-icon', function () {

    console.log('Wishlist icon clicked');

    var courseId = $(this).data('course-id');
    var iconElement = $(this).find('i'); // Find the icon inside the clicked element
    var url = '/wishlist/add';

    console.log('Course ID:', courseId);
    console.log('URL:', url);

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            course_id: courseId,
            _token: $('meta[name="csrf-token"]').attr('content')


        },
        success: function (response) {
            console.log('Wishlist response:', response);
            Swal.fire({
                icon: response.status === 'success' ? 'success' : 'error',
                title: response.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            // Update wishlist count dynamically if status is success
            if (response.status === 'success') {
                updateWishlistCount(response.wishlist_count);

                // Update wishlist dropdown
                getWishlist();

                // Change the icon to 'heart' if status is success
                iconElement.removeClass('la-heart-o').addClass('la-heart');

                // If on wishlist page, reload the wishlist data
                if ($('#wishlist-container').length > 0 && typeof loadWishlistData === 'function') {
                    console.log('Reloading wishlist page data...');
                    loadWishlistData();
                }
            }


        },
        error: function (xhr) {
            let message = 'Something went wrong!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            // Check if user is not authenticated (401 error)
            if (xhr.status === 401) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please Login',
                    text: message,
                    showCancelButton: true,
                    confirmButtonText: 'Login Now',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to login page
                        window.location.href = '/login';
                    }
                });
            } else {
                // Show other errors as toast
                Swal.fire({
                    icon: 'error',
                    title: message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        }
    });
});

// Function to update wishlist count
function updateWishlistCount(count) {
    console.log('Updating wishlist count to:', count);
    $('#wishlist-count').text(count);
    $('#wishlist-total').text(count);
}

//getwishlist

function getWishlist(){

    var url = '/wishlist/all';

    $.ajax({
        url: url,
        type: 'GET',
        data: {

            _token: $('meta[name="csrf-token"]').attr('content')


        },
        success: function (response) {
            console.log('Get wishlist response:', response);

             if (response.status === 'success') {
                // Update the wishlist dropdown HTML
                $('#wishlist-course').html(response.html);
                console.log('Wishlist dropdown updated');
            }


        },
        error: function (xhr) {

            let message = 'Something went wrong!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            // Only log error if not 401 (guest users will get 401)
            if (xhr.status !== 401) {
                console.error('Wishlist error:', message, xhr);
            }


        }
    });




}







