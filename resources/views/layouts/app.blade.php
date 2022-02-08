<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AIT Hostel Allotment'</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my-icon.css') }}" rel="stylesheet" type="text/css">
    <style>
    .gradient-colour {
        background-color: white; /* For browsers that do not support gradients */
        background-image: linear-gradient(-90deg,  #ffeaa7,#e84393); /* Standard syntax (must be last) */
    }
    </style>
    @section('head')
        @show
        
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- ManyChat -->
    <script src="//widget.manychat.com/447288012704401.js" async="async"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel gradient-colour">
            <div class="container">
                <a class="navbar-brand mr-auto" href="{{ url('/') }}">
                    <b>AIT Hostel Allotment</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>

                        @elseif (Auth::check('user')) 
                            <li><a class="nav-link btn btn-success" href="{{ route('application.index') }}">
                                <b>Hostel Application</b>
                                </a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b>{{ Auth::user()->name }} <span class="caret"></span></b>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            @yield('content')
        </main>
        {{-- <div class="fb-customerchat"
         page_id="447288012704401">
        </div> --}}

    </div>
        <!--  Copyright Icon -->
        <a href="https://www.facebook.com/profile.php?id=100005598372259" class="made-with-mk" target="_blank">
            <div class="brand">DK</div>
            <div class="made-with">Developed by <strong>DK Yadav of E&TC</strong></div>
        </a>
    @section('footer')
        @show
</body>
</html>
