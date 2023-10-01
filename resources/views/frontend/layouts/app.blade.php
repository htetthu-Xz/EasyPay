<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    

    <!-- Fontawesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- awesome notifiction --}}
    <link rel="stylesheet" href="{{ asset('plugins/awesome-notifications/dist/style.css') }}">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('plugins/attention.css') }}"
    />

    @stack('css')
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="header-menu">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-2 text-center">
                            <a href="{{ route('home') }}">
                                @if (request()->routeIs('home') || request()->routeIs('profile.page') || request()->routeIs('scan'))
                                    <img src="{{ asset('images/logo/easypay.png') }}" alt="" class="mb-1 logo">
                                @else
                                    <a href="#" class="btn-back">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>
                                @endif
                            </a>
                        </div>
                        <div class="col-8 text-center">
                            <a href="">
                                <h3 class="fw-bold app-name">@yield('title')</h3>
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="">
                                <i class="fa-solid fa-bell"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wapper container content">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="bottom-menu">
            <a href="" class="scan-tab">
                <div class="inside u--bounce">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
            </a>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-3 text-center">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fa-solid fa-house"></i>
                                <p>Home</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="{{ route('wallet.page') }}" class="{{ request()->routeIs('wallet.page') ? 'active' : '' }}">
                                <i class="fa-solid fa-wallet"></i>
                                <p>Wallet</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="" class="{{ request()->routeIs('transaction') ? 'active' : '' }}">
                                <i class="fa-solid fa-clipboard"></i>
                                <p>Transaction</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="{{ route('profile.page') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Account</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/app.js') }}" defer></script>    
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('plugins/awesome-notifications/dist/index.var.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('frontend.layouts.toast')

    <script>
        $(() => {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            $.ajaxSetup({
                headers : {
                    'X-CSRF_TOKEN' : token.content,
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json'   
                }
            });

            $('.btn-back').on('click', function() {
                window.history.go(-1);
                return false;
            })
        })
    </script>

    @stack('script')

</body>
</html>
