@forelse($wishlist as $item)
<div class="col-lg-4 responsive-column-half">
    <div class="card card-item">
        <div class="card-image">
            <a href="{{ route('course-details', $item->course->course_name_slug) }}" class="d-block">
                <img class="card-img-top" src="{{ asset($item->course->course_image) }}" alt="Course image">
            </a>
        </div>
        <div class="card-body">
            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $item->course->label ?? 'All Levels' }}</h6>
            <h5 class="card-title">
                <a href="{{ route('course-details', $item->course->course_name_slug) }}">{{ $item->course->course_name }}</a>
            </h5>
            <p class="card-text">
                <a href="#">{{ $item->course->user->name ?? 'Unknown Instructor' }}</a>
            </p>
            <div class="rating-wrap d-flex align-items-center py-2">
                @php
                    $enrollmentCount = $item->course->orders()->count();
                @endphp
                @if($enrollmentCount > 0)
                <div class="review-stars">
                    <span class="la la-user"></span>
                </div>
                <span class="rating-total pl-1">({{ number_format($enrollmentCount) }} {{ $enrollmentCount == 1 ? 'student' : 'students' }})</span>
                @else
                <div class="review-stars">
                    <span class="badge badge-info">New Course</span>
                </div>
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-price text-black font-weight-bold">
                    ${{ $item->course->discount_price ?? $item->course->selling_price }}
                    @if($item->course->discount_price && $item->course->selling_price > $item->course->discount_price)
                        <span class="before-price font-weight-medium">${{ $item->course->selling_price }}</span>
                    @endif
                </p>
                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                     onclick="removeFromWishlist({{ $item->id }})"
                     title="Remove from Wishlist">
                    <i class="la la-times"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="card card-item">
        <div class="card-body text-center py-5">
            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" height="80px" viewBox="0 0 24 24" width="80px" fill="#ccc">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"/>
            </svg>
            <h4 class="mb-3">Your wishlist is empty</h4>
            <p class="text-gray mb-4">Explore our courses and add your favorites to your wishlist!</p>
            <div class="btn-box">
                <a href="{{ route('all.courses') }}" class="btn theme-btn">
                    <i class="la la-search mr-1"></i> Browse Courses
                </a>
            </div>
        </div>
    </div>
</div>
@endforelse
