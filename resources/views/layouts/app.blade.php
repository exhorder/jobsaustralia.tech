<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Matchmaking for job seekers in the Australian IT sector.">
    <meta name="author" content="Aaron Horler, Ozlem Kirmizi, Kim Luu, Melissa Nguyen, and Dennis Mihalache.">
    <meta name="url" content="{{ Request::url() }}">

    <!-- Geo tags -->
    <meta name="geo.region" content="AU-VIC">
    <meta name="geo.placename" content="Melbourne">
    <meta name="geo.position" content="-37.80742;144.963795">
    <meta name="ICBM" content="-37.80742, 144.963795">

    <!-- Privacy -->
    <meta name="referrer" content="no-referrer">
    <meta http-equiv="x-dns-prefetch-control" content="off">
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JobsAustralia.tech Job Seekers</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(Request::getHttpHost() == "jobsaustralia.tech")
        <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/icomoon/style.css') }}" rel="stylesheet" type="text/css">

    <link rel="license" href="/terms">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#1d272c">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ asset('/') }}">
                        <span class="icon-jobsaustralia-logo"></span> JobsAustralia.tech Job Seekers
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::guest())
                            <li><a href="{{ route('matches') }}">Matches</a></li>
                            <li><a href="{{ route('applications') }}">Applications</a></li>
                        @endif
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('support') }}">Support</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ substr(Auth::user()->name, 0, 20) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile') }}">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a id="logout" href="{{ route('logout') }}">
                                            Logout
                                        </a>

                                        <form id="logout-form" class="default-hide" action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        <br><br>
        <footer>
            <p>Copyright © JobsAustralia.tech 2017 &bull; <i class="fa fa-github" aria-hidden="true"></i> <a href="https://github.com/jobsaustralia/">GitHub</a> &bull; <a href="{{ route('terms') }}">Legal</a></p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
    @if(Request::getHttpHost() == "jobsaustralia.tech")
        <script src="{{ asset('js/custom.min.js') }}"></script>
    @else
        <script src="{{ asset('js/custom.js') }}"></script>
    @endif
    @if(Request::path() === 'matches' || substr(Request::path(), 0, 3) === 'job' || substr(Request::path(), 0, 8) === 'employer')
        @if(Request::getHttpHost() == "jobsaustralia.tech")
            <script src="{{ asset('js/match.min.js') }}"></script>
        @else
            <script src="{{ asset('js/match.js') }}"></script>
        @endif
    @endif
</body>
</html>
