<!doctype html>
<html lang="en">

<head>
    @include('backend.section.link')
    <title>Cyduca - Instructor Dashboard</title>
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/logo.png') }}">
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('backend.instructor.sidebar')

        <!--start header -->
        @include('backend.instructor.header')

        <!--start page wrapper -->
        <div class="page-wrapper">

            @yield('content')

        </div>
        <!--end page wrapper -->


       @include('backend.section.footer')



    </div>
    <!--end wrapper-->


    <!-- Bootstrap JS -->
    @include('backend.section.script')

</body>

</html>
