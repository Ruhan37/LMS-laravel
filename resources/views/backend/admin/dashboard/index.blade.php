@extends('backend.admin.master')

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
                            <p class="mb-0 font-13">All courses in system</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class='bx bx-book'></i>
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
                            <p class="mb-0 font-13">Total earnings</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                            <i class='bx bxs-wallet'></i>
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
                            <p class="mb-0 font-13">Registered users</p>
                        </div>
                        <div
                            class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
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
                            <p class="mb-0 text-secondary">Total Instructors</p>
                            <h4 class="my-1 text-warning">{{ $totalInstructors }}</h4>
                            <p class="mb-0 font-13">Active instructors</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                            <i class='bx bxs-user-badge'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Sales Overview</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #14abef"></i>Sales</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #ffc107"></i>Orders</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div
                    class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">${{ number_format($monthlyRevenue, 2) }}</h5>
                            <small class="mb-0">This Month Revenue</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $monthlyOrders }}</h5>
                            <small class="mb-0">Orders This Month</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{ $pendingCourses }}</h5>
                            <small class="mb-0">Pending Courses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Top Categories</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.category.index') }}">View All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-2">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($topCategories as $category)
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center {{ !$loop->first ? 'border-top' : '' }}">
                        {{ $category->name }} <span class="badge bg-success rounded-pill">{{ $category->course_count }}</span>
                    </li>
                    @empty
                    <li class="list-group-item d-flex bg-transparent justify-content-center align-items-center">
                        <small class="text-muted">No categories yet</small>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div><!--end row-->

    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Orders</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                        data-bs-toggle="dropdown"><i
                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Course</th>
                            <th>Student</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="recent-product-img">
                                        <img src="{{ $order->course->image }}" class="product-img-2" alt="course img">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1 font-14">{{ Str::limit($order->course->course_name, 30) }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->user->name }}</td>
                            <td>
                                @if($order->payment)
                                    <span class="badge {{ $order->payment->status == 'complete' ? 'bg-gradient-quepal' : 'bg-warning' }} text-white shadow-sm w-100">
                                        {{ ucfirst($order->payment->status ?? 'Pending') }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white shadow-sm w-100">N/A</span>
                                @endif
                            </td>
                            <td>${{ number_format($order->price, 2) }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-primary"><i class='bx bxs-show'></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No recent orders</p>
                            </td>
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
<script>
    // Chart 1 - Sales Overview
    $(function() {
        "use strict";

        var ctx1 = document.getElementById("chart1");
        if (ctx1) {
            ctx1 = ctx1.getContext('2d');
            var myChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesChartLabels) !!},
                    datasets: [{
                        label: 'Sales ($)',
                        data: {!! json_encode($salesChartData) !!},
                        backgroundColor: 'transparent',
                        borderColor: '#14abef',
                        pointBackgroundColor: '#14abef',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#14abef',
                        tension: 0.4
                    }, {
                        label: 'Orders',
                        data: {!! json_encode($ordersChartData) !!},
                        backgroundColor: 'transparent',
                        borderColor: '#ffc107',
                        pointBackgroundColor: '#ffc107',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#ffc107',
                        tension: 0.4
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });

    // Chart 2 - Top Categories
    $(function() {
        "use strict";

        var ctx2 = document.getElementById("chart2");
        if (ctx2) {
            ctx2 = ctx2.getContext('2d');
            var myChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryChartLabels) !!},
                    datasets: [{
                        data: {!! json_encode($categoryChartData) !!},
                        backgroundColor: ['#14abef', '#02ba5a', '#d13adf', '#fba540', '#ff6384', '#36a2eb', '#cc65fe']
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
