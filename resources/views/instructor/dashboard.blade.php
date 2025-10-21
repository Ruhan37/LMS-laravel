@extends('layouts.backend')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Courses</p>
                            <h4 class="my-1 text-info">{{ $totalCourses }}</h4>
                            <p class="mb-0 font-13">Your courses</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                            <i class='bx bx-book'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Earnings</p>
                            <h4 class="my-1 text-success">${{ number_format($totalEarnings, 2) }}</h4>
                            <p class="mb-0 font-13">Lifetime earnings</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                            <i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Students</p>
                            <h4 class="my-1 text-danger">{{ $totalStudents }}</h4>
                            <p class="mb-0 font-13">Enrolled students</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                            <i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Pending Courses</p>
                            <h4 class="my-1 text-warning">{{ $pendingCourses }}</h4>
                            <p class="mb-0 font-13">Awaiting approval</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                            <i class='bx bx-time'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Earnings Overview</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Earnings</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">${{ number_format($monthlyEarnings, 2) }}</h5>
                            <small class="mb-0">This Month</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $monthlyEnrollments }}</h5>
                            <small class="mb-0">Enrollments This Month</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ number_format($averageRating, 1) }}</h5>
                            <small class="mb-0">Average Rating</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Course Performance</h6>
                        </div>
                    </div>
                    <div class="chart-container-2 mt-4">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($topCourses as $course)
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{ Str::limit($course->course_name, 20) }} <span class="badge bg-success rounded-pill">{{ $course->students_count }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div><!--end row-->

    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Enrollments</h6>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('instructor.orders') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEnrollments as $enrollment)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="recent-product-img">
                                        @if($enrollment->user->photo)
                                            <img src="{{ asset('storage/' . $enrollment->user->photo) }}" alt="">
                                        @else
                                            <img src="{{ asset('backend/assets/images/avatars/avatar-1.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">{{ $enrollment->user->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ Str::limit($enrollment->course->course_name, 30) }}</td>
                            <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                            <td>${{ number_format($enrollment->amount, 2) }}</td>
                            <td>
                                <div class="badge rounded-pill {{ $enrollment->status == 'completed' ? 'bg-success' : 'bg-warning' }} w-100">
                                    {{ ucfirst($enrollment->status) }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No recent enrollments</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }}"></script>
<script>
    // Chart 1 - Earnings Overview
    $(function() {
        "use strict";
        var ctx = document.getElementById("chart1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($earningsChartLabels) !!},
                datasets: [{
                    label: 'Earnings',
                    data: {!! json_encode($earningsChartData) !!},
                    backgroundColor: 'rgba(20, 171, 239, 0.1)',
                    borderColor: '#14abef',
                    pointBackgroundColor: '#14abef',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#14abef',
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                }
            }
        });
    });

    // Chart 2 - Course Performance
    $(function() {
        "use strict";
        var ctx = document.getElementById("chart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($courseChartLabels) !!},
                datasets: [{
                    data: {!! json_encode($courseChartData) !!},
                    backgroundColor: ['#14abef', '#02ba5a', '#d13adf', '#fba540', '#ff6384']
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    display: false
                }
            }
        });
    });
</script>
@endpush
