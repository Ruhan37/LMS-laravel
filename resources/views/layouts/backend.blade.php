<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon-->
    <link rel="icon" href="{{ asset('frontend/images/logo.png') }}" type="image/png"/>

    <!--plugins-->
    <link href="{{ asset('backend/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>

    <!-- loader-->
    <link href="{{ asset('backend/css/pace.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('backend/js/pace.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/dark-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/semi-dark.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/header-colors.css') }}"/>

    @stack('styles')

    <title>@yield('title', 'Dashboard - Cyduca Admin')</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('partials.backend.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('partials.backend.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        @include('partials.backend.footer')
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('backend/plugins/chartjs/js/chart.js') }}"></script>

    <!--app JS-->
    <script src="{{ asset('backend/js/app.js') }}?v={{ time() }}"></script>

    <script>
        // Wait for all scripts to load
        $(window).on('load', function() {
            // Load saved theme on page load
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark-theme') {
                $('html').attr('class', 'dark-theme');
                $('.dark-mode-icon i').attr('class', 'bx bx-sun');
            } else if (savedTheme === 'light-theme') {
                $('html').attr('class', 'light-theme');
                $('.dark-mode-icon i').attr('class', 'bx bx-moon');
            }

            // Override the default dark mode toggle to add localStorage support
            setTimeout(function() {
                $('.dark-mode').off('click').on('click', function(e) {
                    e.preventDefault();
                    if ($('.dark-mode-icon i').attr('class') == 'bx bx-sun') {
                        $('.dark-mode-icon i').attr('class', 'bx bx-moon');
                        $('html').attr('class', 'light-theme');
                        localStorage.setItem('theme', 'light-theme');
                    } else {
                        $('.dark-mode-icon i').attr('class', 'bx bx-sun');
                        $('html').attr('class', 'dark-theme');
                        localStorage.setItem('theme', 'dark-theme');
                    }
                });
            }, 100);

            // Mark notification as read on click
            $('.notification-item').click(function(e) {
                var notificationId = $(this).data('id');
                var link = $(this).attr('href');

                e.preventDefault();

                $.ajax({
                    url: '/admin/notifications/' + notificationId + '/read',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = link;
                    }
                });
            });

            // Mark all notifications as read
            $('#mark-all-read').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("admin.notifications.markAllRead") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
