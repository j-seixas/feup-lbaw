<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar bg-white fixed-top navbar-expand-md box-shadow navbar-light">
        <a class="navbar-brand h1 mb-0" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg') }}" width="30" height="30" class="d-inline-block align-top" alt=""> Eventually
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Find an event..." aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0 mr-3" type="submit">Search</button>
            </form>
            <a href="{{url('event')}}">
                <button type="button" class="btn btn-primary ">
                    <i class="fas fa-plus"></i> Create event
                </button>
            </a>
            @if (Auth::check())
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="./profile.html">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="./myevents.html">My events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="./notifications.html">
                        <i class="fas fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('register') }}">Sign up</a>
                </li>
            </ul>
            @endif
        </div>
    </nav>
    @yield('content')
    <footer class="footer container py-5">
        <div class="row">
            <div class="col-sm">
                <small class="d-block mb-3 text-muted">Eventually &copy; 2018<br>build 6</small>
            </div>
            <div class="col">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-muted" href="./faq">Frequently asked questions</a>
                    </li>
                    <li>
                        <a class="text-muted" href="./terms">Terms and conditions</a>
                    </li>
                    <li>
                        <a class="text-muted" href="./privacy">Privacy</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <h5>About us</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-muted" href="./about">About us</a>
                    </li>
                    <li>
                        <a class="text-muted" href="./team">Our team</a>
                    </li>
                    <li>
                        <a class="text-muted" href="./contacts">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</html>