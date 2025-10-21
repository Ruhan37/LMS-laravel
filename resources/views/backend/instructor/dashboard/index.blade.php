@extends('backend.instructor.master')

@section('content')
    <div class="page-content">

        @if (!isApprovedUser())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">
                    <p style="font-size: 20px">Your account is inactive. Please wait admin will check & approved it</p>
                </div>
            </div>
        @endif

        {{-- Instructor Stats Cards --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Courses</p>
                                <h4 class="my-1 text-info">{{ $totalCourses }}</h4>
                                <p class="mb-0 font-13">Active: {{ $activeCourses }} | Pending: {{ $pendingCourses }}</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class='bx bx-book-open'></i>
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
                                <p class="mb-0 text-secondary">Total Students</p>
                                <h4 class="my-1 text-success">{{ $totalStudents }}</h4>
                                <p class="mb-0 font-13">Enrolled in your courses</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bx-group'></i>
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
                                <p class="mb-0 text-secondary">Total Revenue</p>
                                <h4 class="my-1 text-danger">${{ number_format($totalRevenue, 2) }}</h4>
                                <p class="mb-0 font-13">From course sales</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                <i class='bx bx-dollar'></i>
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
                                <p class="mb-0 text-secondary">Active Courses</p>
                                <h4 class="my-1 text-warning">{{ $activeCourses }}</h4>
                                <p class="mb-0 font-13">Published & live</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bx-check-circle'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            {{-- Popular Courses --}}
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Your Popular Courses</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Category</th>
                                        <th>Students</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($popularCourses as $course)
                                        <tr>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->category->category_name ?? 'N/A' }}</td>
                                            <td><span class="badge bg-primary">{{ $course->orders_count }}</span></td>
                                            <td>
                                                @if($course->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>${{ number_format($course->selling_price, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No courses yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Course Statistics</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="courseChart"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            Total Courses <span class="badge bg-primary rounded-pill">{{ $totalCourses }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Active <span class="badge bg-success rounded-pill">{{ $activeCourses }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Pending <span class="badge bg-warning rounded-pill">{{ $pendingCourses }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Total Students <span class="badge bg-info rounded-pill">{{ $totalStudents }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--end row-->

        {{-- Recent Enrollments --}}
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Enrollments</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEnrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->user->name }}</td>
                                    <td>{{ $enrollment->course->course_name }}</td>
                                    <td>${{ number_format($enrollment->price, 2) }}</td>
                                    <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-gradient-quepal text-white shadow-sm">Enrolled</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No enrollments yet</td>
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
    <script src="{{ asset('backend/plugins/chartjs/js/chart.js') }}"></script>
    <script>
        // Course Statistics Doughnut Chart
        var ctx = document.getElementById('courseChart').getContext('2d');
        var courseChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Pending'],
                datasets: [{
                    data: [{{ $activeCourses }}, {{ $pendingCourses }}],
                    backgroundColor: ['#0d6efd', '#ffc107'],
                    borderWidth: 0
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush