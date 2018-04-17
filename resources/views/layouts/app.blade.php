<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>