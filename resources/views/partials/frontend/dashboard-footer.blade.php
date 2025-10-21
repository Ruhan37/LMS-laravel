<div class="row align-items-center dashboard-copyright-content pb-4">
    <div class="col-lg-6">
        <p class="copy-desc">&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
    </div><!-- end col-lg-6 -->
    <div class="col-lg-6">
        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 justify-content-end">
            <li class="mr-3"><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
        </ul>
    </div><!-- end col-lg-6 -->
</div><!-- end row -->
