@extends('backend.user.master')

@section('content')

<div class="dashboard-heading mb-5">
    <h3 class="fs-22 font-weight-semi-bold">Purchase History</h3>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-item">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">All Purchases</h5>
                    <div class="text-right">
                        <p class="text-muted mb-0">Total Spent</p>
                        <h4 class="text-success font-weight-bold">${{ number_format($totalSpent, 2) }}</h4>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Course</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($order->course)
                                                <img src="{{ $order->course->course_image ? asset($order->course->course_image) : asset('frontend/images/img8.jpg') }}"
                                                    alt="Course" class="rounded mr-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <strong>{{ $order->course->course_name }}</strong>
                                                </div>
                                            @else
                                                <span class="text-muted">Course not available</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="font-weight-bold text-success">${{ number_format($order->price, 2) }}</td>
                                    <td>
                                        <span class="badge badge-success">Completed</span>
                                    </td>
                                    <td>
                                        @if($order->course)
                                            <a href="{{ route('course-details', $order->course->course_name_slug) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="la la-eye"></i> View Course
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" height="60px" viewBox="0 0 24 24" width="60px" fill="#ccc">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                                        </svg>
                                        <h5>No Purchase History</h5>
                                        <p class="text-muted">You haven't made any purchases yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
