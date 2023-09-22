<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app_dark.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datatables.css') }}">


    @stack('css')
</head>
<body>
    <div id="app">

        @include('backend.layouts.header')

        <div id="main">

            @include('backend.layouts.nav')

            <div class="page-content">
                @yield('content')
            </div>

            @include('backend.layouts.footer')

        </div>
    </div>

    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/pages/horizontal-layout.js') }}"></script>
    <script src="{{ asset('backend/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/js/pages/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    @include('backend.layouts.toast')

    <script>
        $(() => {
            $('.cancel-btn').on('click', function() {
                window.history.go(-1);
                return false;
            })
        })
    </script>

    @routes

    @stack('script')
</body>
</html>