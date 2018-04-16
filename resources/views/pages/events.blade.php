@extends('layouts.app')

@section('title', 'Home')

@section('content')

@if (!Auth::check())
<div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Greetings Humans!</h1>
            <p>Eventually is an event management website that allows you to interact with other people by creating and joining
                events. You can even create private events for close friends like a birthday party! Isn't that bonkers? Sign
                up today or come back to our warm community by signing in!
            </p>
        </div>
    </div>
@endif

<div class="container ">
@each('partials.event', $events, 'event')
</div>

@endsection
