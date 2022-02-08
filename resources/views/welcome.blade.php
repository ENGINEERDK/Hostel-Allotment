<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome | AIT Hostel Allotment Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <!-- ManyChat -->
        <script src="//widget.manychat.com/447288012704401.js" async="async"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="bottom-left">
                    <a href="{{ url('/admin') }}">ADMIN LOGIN</a>
                </div>
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    AIT Hostel Allotment Portal
                </div>
            
                <div class="links">
                    <ul>Merit Based Hostel Allotment</ul>
                    <ul>Transparent Process</ul>
                    <ul>Fully Automized</ul>
                    <br>
                    <ul style="font-size: 15px; color: green;">
                         You can now see the allotment result generated Online, through this portal.</ul>
                    <ul style="font-size: 18px; background-color:black; color: green;" class="text-center"> College management has denied to use this method for Hostel Allotment. Giving reason, they dont know how its working. We will be showing your feedback focing them to accept the reality and make sure these things happen correctly from next year.</ul>

                </div>
            </div>
            <div class="bottom-zero">
                @Deepak K. Yadav, AIT Pune
            </div>
        </div>
    </body>
</html>
