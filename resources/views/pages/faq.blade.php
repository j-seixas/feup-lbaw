@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="jumbotron">
    <div class="container">
        <h3 class="display-4">FAQ</h3>
        <ul>
            <li>Can I delete an event?
                <ul>
                    <li>Only if you are the event creator.</li>
                </ul>
            </li>
            <li>How can I join a private event if I was not invited?
                <ul>
                    <li>You have to ask for invitation from the owner or admin. Just search for them and send them a message.</li>
                </ul>
            </li>
        </ul>
    </div>
</div>

@endsection