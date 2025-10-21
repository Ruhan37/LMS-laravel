@extends('layouts.frontend-dashboard')

@section('title', 'My Dashboard')

@section('content')
<div class="dashboard-content-wrap">
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3">
        <i class="la la-bars mr-1"></i> Dashboard Nav
    </div>
    <div class="container-fluid">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
            <div class="media media-card align-items-center">
                <div class="media-img media--img media-img-md rounded-full">
                    @if(auth()->user()->photo)
                        <img class="rounded-full" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Student thumbnail image">
                    @else
                        <img class="rounded-full" src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Student thumbnail image">
                    @endif
                </div>
                <div class="media-body">
                    <h2 class="section__title fs-30">Howdy, {{ auth()->user()->name }}</h2>
                    <div class="rating-wrap d-flex align-items-center pt-2">
                        <div class="review-stars">
                            <span class="rating-number">{{ number_format($averageRating, 1) }}</span>
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    <span class="la la-star"></span>
                                @else
                                    <span class="la la-star-o"></span>
                                @endif
                            @endfor
                        </div>
                        <span class="rating-total pl-1">({{ $totalReviews }})</span>
                    </div><!-- end rating-wrap -->
                </div><!-- end media-body -->
            </div><!-- end media -->
            <a href="{{ route('courses.index') }}" class="btn theme-btn"><i class="la la-plus mr-1"></i> Find More Courses</a>
        </div><!-- end breadcrumb-content -->
        <div class="section-block mb-5"></div>
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">Dashboard</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-1 text-white">
                            <svg class="svg-icon-color-white" width="40" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                <g><g><path d="M245.333,85.333c-41.173,0-74.667,33.493-74.667,74.667s33.493,74.667,74.667,74.667S320,201.173,320,160 C320,118.827,286.507,85.333,245.333,85.333z"/></g></g>
                            </svg>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">Enrolled Courses</p>
                            <h5 class="card-title pt-2 fs-26">{{ $enrolledCourses }}</h5>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-2 text-white">
                            <svg class="svg-icon-color-white" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                <g><g><g><path d="M405.333,42.667h-44.632c-4.418-12.389-16.147-21.333-30.035-21.333h-32.229C288.417,8.042,272.667,0,256,0 s-32.417,8.042-42.438,21.333h-32.229c-13.888,0-25.617,8.944-30.035,21.333h-44.631C83.146,42.667,64,61.802,64,85.333v384 C64,492.865,83.146,512,106.667,512h298.667C428.854,512,448,492.865,448,469.333v-384C448,61.802,428.854,42.667,405.333,42.667z"/></g></g></g>
                            </svg>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">Active Courses</p>
                            <h5 class="card-title pt-2 fs-26">{{ $activeCourses }}</h5>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-3 text-white">
                            <svg class="svg-icon-color-white" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                <g><g><g><path d="M405.333,42.667h-44.632c-4.418-12.389-16.147-21.333-30.035-21.333h-32.229C288.417,8.042,272.667,0,256,0 s-32.417,8.042-42.438,21.333h-32.229c-13.888,0-25.617,8.944-30.035,21.333h-44.631C83.146,42.667,64,61.802,64,85.333v384 C64,492.865,83.146,512,106.667,512h298.667C428.854,512,448,492.865,448,469.333v-384C448,61.802,428.854,42.667,405.333,42.667z"/></g></g></g>
                            </svg>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">Completed Courses</p>
                            <h5 class="card-title pt-2 fs-26">{{ $completedCourses }}</h5>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">My Learning Progress</h3>
                        <div class="divider"><span></span></div>
                        <div class="row pt-4">
                            @forelse($myCourses as $course)
                            <div class="col-lg-4 mb-4">
                                <div class="media media-card">
                                    <a href="{{ route('course.lessons', $course->id) }}" class="media-img">
                                        <img class="mr-3" src="{{ asset('storage/' . $course->image) }}" alt="Course thumbnail image">
                                    </a>
                                    <div class="media-body">
                                        <h5><a href="{{ route('course.lessons', $course->id) }}">{{ Str::limit($course->course_name, 40) }}</a></h5>
                                        <div class="skillbar-box pt-3">
                                            <div class="skillbar skillbar-skillbar" data-percent="{{ $course->progress ?? 0 }}%">
                                                <div class="skillbar-bar skillbar--bar bg-1"></div>
                                            </div><!-- End Skill Bar -->
                                        </div><!-- End skillbar-box -->
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-12">
                                <p class="text-center">You haven't enrolled in any courses yet.</p>
                                <div class="text-center mt-3">
                                    <a href="{{ route('courses.index') }}" class="btn theme-btn">Browse Courses <i class="la la-arrow-right icon ml-1"></i></a>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        @if($myCourses->isNotEmpty())
                        <div class="text-center pt-3">
                            <a href="{{ route('my-courses') }}" class="btn theme-btn">View All Courses <i class="la la-arrow-right icon ml-1"></i></a>
                        </div>
                        @endif
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->

        @include('partials.frontend.dashboard-footer')
    </div><!-- end container-fluid -->
</div><!-- end dashboard-content-wrap -->
@endsection
