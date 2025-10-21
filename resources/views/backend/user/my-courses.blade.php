@extends('backend.user.master')

@section('content')

<div class="dashboard-heading mb-5">
    <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
</div>

<div class="row">
    @forelse($enrolledCourses as $enrollment)
        <div class="col-lg-4 responsive-column-half">
            <div class="card card-item">
                <div class="card-image">
                    <a href="{{ route('course-details', $enrollment->course->course_name_slug) }}" class="d-block">
                        <img class="card-img-top lazy" src="{{ $enrollment->course->course_image ? asset($enrollment->course->course_image) : asset('frontend/images/img8.jpg') }}"
                            alt="Course image">
                    </a>
                    <div class="course-badge-labels">
                        @if($enrollment->course->discount_price)
                            <div class="course-badge">Bestseller</div>
                        @endif
                    </div>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                        {{ $enrollment->course->category->category_name ?? 'Uncategorized' }}
                    </h6>
                    <h5 class="card-title">
                        <a href="{{ route('course-details', $enrollment->course->course_name_slug) }}">{{ $enrollment->course->course_name }}</a>
                    </h5>
                    <p class="card-text">
                        <a href="{{ route('course-details', $enrollment->course->course_name_slug) }}" class="text-gray">
                            By {{ $enrollment->course->user->name ?? 'Unknown' }}
                        </a>
                    </p>
                    <div class="rating-wrap d-flex align-items-center py-2">
                        <div class="review-stars">
                            <span class="rating-number">4.4</span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                        </div>
                        <span class="rating-total pl-1">(20,230)</span>
                    </div><!-- end rating-wrap -->
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-price text-black font-weight-bold">
                            ${{ number_format($enrollment->course->selling_price, 2) }}
                            @if($enrollment->course->discount_price)
                                <span class="before-price font-weight-medium">${{ number_format($enrollment->course->discount_price, 2) }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('course-details', $enrollment->course->course_name_slug) }}" class="btn theme-btn w-100">
                            <i class="la la-play-circle mr-1"></i> Start Learning
                        </a>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 -->
    @empty
        <div class="col-lg-12">
            <div class="card card-item">
                <div class="card-body text-center py-5">
                    <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" height="60px" viewBox="0 0 24 24" width="60px" fill="#ccc">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                    </svg>
                    <h4 class="mb-2">No Courses Yet</h4>
                    <p class="text-gray">You haven't enrolled in any courses yet. Browse our course catalog to get started!</p>
                    <a href="{{ route('frontend.home') }}" class="btn theme-btn mt-3">
                        <i class="la la-search mr-1"></i> Browse Courses
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div><!-- end row -->

@endsection
