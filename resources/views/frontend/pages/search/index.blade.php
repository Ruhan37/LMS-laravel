@extends('frontend.master')

@section('content')

<!-- Breadcrumb -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Search Results</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{ route('frontend.home') }}">Home</a></li>
                <li>Search</li>
            </ul>
        </div>
    </div>
</section>

<!-- Course Area -->
<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-15">
                    @if($courses->total() > 0)
                        Showing <strong>{{ $courses->firstItem() }}-{{ $courses->lastItem() }}</strong> of <strong>{{ $courses->total() }}</strong> results for "<strong>{{ $searchTerm }}</strong>"
                    @else
                        No results found for "<strong>{{ $searchTerm }}</strong>"
                    @endif
                </p>
            </div>
        </div>

        <div class="row">
            @forelse($courses as $course)
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item card-preview" data-tooltip-content="#{{ $course->course_name_slug }}">
                        <div class="card-image">
                            <a href="{{ route('course-details', $course->course_name_slug) }}" class="d-block">
                                <img class="card-img-top lazy" width="240" height="240"
                                    src="{{ asset($course->course_image) }}"
                                    data-src="{{ asset($course->course_image) }}" alt="Course image">
                            </a>
                            @if($course->bestseller == 'yes' || $course->featured == 'yes' || $course->discount_price)
                                <div class="course-badge-labels">
                                    @if($course->bestseller == 'yes')
                                        <div class="course-badge">Bestseller</div>
                                    @elseif($course->featured == 'yes')
                                        <div class="course-badge">Featured</div>
                                    @else
                                        <div class="course-badge">HighestRated</div>
                                    @endif

                                    @if($course->discount_price && $course->selling_price > $course->discount_price)
                                        <div class="course-badge blue">
                                            -{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                {{ $course->category->name ?? 'All Levels' }}
                            </h6>
                            <h5 class="card-title">
                                <a href="{{ route('course-details', $course->course_name_slug) }}">
                                    {{ \Illuminate\Support\Str::limit($course->course_name, 50) }}
                                </a>
                            </h5>
                            <p class="card-text">
                                <a href="#">{{ $course->user->name ?? 'Unknown Instructor' }}</a>
                            </p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                @php
                                    $enrollmentCount = $course->orders()->count();
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
                                    ${{ $course->discount_price ?? $course->selling_price }}
                                    @if($course->discount_price && $course->selling_price > $course->discount_price)
                                        <span class="before-price font-weight-medium">${{ $course->selling_price }}</span>
                                    @endif
                                </p>

                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist-icon"
                                    title="Add to Wishlist" data-course-id="{{ $course->id }}">
                                    @auth
                                        @php
                                            $isInWishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                                                ->where('course_id', $course->id)
                                                ->exists();
                                        @endphp
                                        <i class="la {{ $isInWishlist ? 'la-heart' : 'la-heart-o' }}"></i>
                                    @else
                                        <i class="la la-heart-o"></i>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="card card-item">
                        <div class="card-body text-center py-5">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" height="80px" viewBox="0 0 24 24" width="80px" fill="#ccc">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                            <h4 class="mb-3">No courses found</h4>
                            <p class="text-gray mb-4">We couldn't find any courses matching "{{ $searchTerm }}"</p>
                            <p class="text-gray mb-3">Try searching with different keywords or browse our categories:</p>
                            <div class="btn-box">
                                <a href="{{ route('frontend.home') }}" class="btn theme-btn">
                                    <i class="la la-home mr-1"></i> Go to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if($courses->total() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-navigation-wrap mt-4">
                        <div class="page-navigation mx-auto">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
