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
    <link rel="stylesheet" href="{{ asset('backend/css/iconly.css') }}">
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
</body>
</html>