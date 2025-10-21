@extends('backend.user.master')

@section('content')

<div class="dashboard-heading mb-5">
    <h3 class="fs-22 font-weight-semi-bold">Messages</h3>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-item">
            <div class="card-body text-center py-5">
                <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" height="80px" viewBox="0 0 24 24" width="80px" fill="#ccc">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/>
                </svg>
                <h4 class="mb-3">Messages Feature Coming Soon</h4>
                <p class="text-gray mb-4">We're working on bringing you a messaging system to communicate with instructors and other students.</p>
                <div class="alert alert-info d-inline-block">
                    <i class="la la-info-circle mr-1"></i>
                    This feature is currently under development
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
