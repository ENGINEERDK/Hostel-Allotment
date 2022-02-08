<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hostel Allotment') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my-icon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/layout.css') }}" rel="stylesheet" type="text/css">
                {{-- self defined css properties --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css"> 
    <style>
    .gradient-colour {
        background-color: white; /* For browsers that do not support gradients */
        background-image: linear-gradient(-90deg,#FFC312,#12CBC4); /* Standard syntax (must be last) */
    }
    </style>
    @section('head')
        @show
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel gradient-colour">
            <div class="container">
                <a class="navbar-brand" href="{{ route('allotment.index') }}">
                    <b>AIT Hostel Management</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest('admin')
                        <li class="nav-item">
                            <li><a class="nav-link btn btn-success" href="{{ route('application.index')}}">
                                <b>Students Side</b>
                                </a></li>
                            <li><a class="nav-link" href="{{ route('admin.login') }}">{{ __('Admin-Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a></li>
                        </li>
                        @else
                        <li><a class="nav-link btn btn-success" href="{{ route('info.index') }}">
                                <b>Students Details</b>
                                </a>
                        </li>
                        @admin('super')
                        <li>
                            <a class="nav-link btn btn-success" href="{{ route('settings.index') }}"> <b>Allotment Settings</b>
                                </a>
                        </li>
                        @endadmin
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    <b>{{ auth('admin')->user()->name }} <span class="caret"></span></b>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @admin('super')
                                    <a class="dropdown-item" href="{{ route('admin.show') }}">{{ ucfirst(config('multiauth.prefix')) }}</a>
                                    <a class="dropdown-item" href="{{ route('admin.roles') }}">Roles</a>
                                @endadmin
                                    <a class="dropdown-item" href="{{ route('admin.password.change') }}">Change Password</a>
                                <a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @section('footer')
        @show
</body>

</html>