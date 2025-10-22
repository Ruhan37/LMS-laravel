@extends('backend.user.master')

@section('content')
    <div class="row" id="wishlist-container">

        <!-- Wishlist items will be loaded here via Ajax -->

    </div><!-- end row -->

    <?php
    $user_id = auth()->user()->id;
    $wishlist = App\Models\Wishlist::where('user_id', $user_id)->count();
    ?>

    @if ($wishlist)
        <div class="text-center py-3">
            <nav aria-label="Page navigation example" class="pagination-box">
                <ul class="pagination justify-content-center" id="pagination-box">

                </ul>

            </nav>

        </div>
    @endif
@endsection

@push('scripts')
<script>
    // Load wishlist data when page loads
    $(document).ready(function() {
        console.log('Loading wishlist data...');
        loadWishlistData();
    });

    function loadWishlistData() {
        $.ajax({
            url: '/user/wishlist-data',
            type: 'GET',
            success: function(response) {
                console.log('Wishlist data loaded:', response);
                if (response.status === 'success') {
                    $('#wishlist-container').html(response.html);

                    // Update pagination if available
                    if (response.wishlist && response.wishlist.links) {
                        updatePagination(response.wishlist);
                    }
                }
            },
            error: function(xhr) {
                console.error('Error loading wishlist:', xhr);
                $('#wishlist-container').html('<div class="col-12"><p class="text-center">Error loading wishlist items.</p></div>');
            }
        });
    }

    function updatePagination(wishlist) {
        // Update pagination links
        let paginationHtml = '';
        if (wishlist.links && wishlist.links.length > 3) {
            wishlist.links.forEach(function(link) {
                if (link.label === '&laquo; Previous') {
                    paginationHtml += `<li class="page-item ${!link.url ? 'disabled' : ''}">
                        <a class="page-link" href="${link.url || '#'}" onclick="loadWishlistPage('${link.url}'); return false;">Previous</a>
                    </li>`;
                } else if (link.label === 'Next &raquo;') {
                    paginationHtml += `<li class="page-item ${!link.url ? 'disabled' : ''}">
                        <a class="page-link" href="${link.url || '#'}" onclick="loadWishlistPage('${link.url}'); return false;">Next</a>
                    </li>`;
                } else {
                    paginationHtml += `<li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="${link.url || '#'}" onclick="loadWishlistPage('${link.url}'); return false;">${link.label}</a>
                    </li>`;
                }
            });
            $('#pagination-box').html(paginationHtml);
        }
    }

    function loadWishlistPage(url) {
        if (!url) return;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    $('#wishlist-container').html(response.html);
                    updatePagination(response.wishlist);
                }
            }
        });
    }

    // Reload wishlist when an item is removed
    $(document).on('click', '.remove-wishlist', function() {
        setTimeout(function() {
            loadWishlistData();
        }, 500);
    });

    // Make removeFromWishlist globally accessible
    window.removeFromWishlist = function(wishlistId) {
        Swal.fire({
            title: 'Remove from Wishlist?',
            text: "Are you sure you want to remove this course from your wishlist?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/user/wishlist/' + wishlistId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });

                            // Reload wishlist data
                            loadWishlistData();

                            // Update wishlist count in header
                            if (typeof updateWishlistCount === 'function') {
                                updateWishlistCount(response.wishlist_count);
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to remove item from wishlist.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            }
        });
    }
</script>
@endpush


