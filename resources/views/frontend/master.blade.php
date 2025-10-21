<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Online Learning Platform</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/favicon.png') }}">

    @include('frontend.section.link')

    @stack('styles')
</head>

<body>
    <!-- start cssload-loader -->
    @include('frontend.section.preloader')

    <!--START HEADER AREA-->
    @include('partials.frontend.header')

    @yield('content')

    <!---footer-area--->
    @include('partials.frontend.footer')

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>

    <!---tooltip--->
    @include('frontend.section.tooltip')

    <!-- template js files -->
    @include('frontend.section.script')

    @stack('scripts')
</body>
</html>
