@extends('layouts.app') 

@section('title', 'Home') 

@section('content')

<div class="container pr-null pb-null pl-null pt-3">
        <div class="row">
            <div class="col-md-7 mb-3 pl-0 pr-0">
                <div class="card position-relative m-auto " id="profile">
                    <div class="card-body">
                        @if($isOwner)
                        <button type="button" class="btn btn-outline-primary float-right">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        @endif
                        <h4 class="card-title">{{ $member->name }}</h4>
                        <h6 class="card-subtitle text-muted">{{ $member->age }} years old</h6>
                    </div>
                    <img style="width: 100%; display: block;" src="@if($member->image) {{ Storage::url($member->image) }} @else {{ asset('img/person_placeholder.png') }} @endif" alt="Profile picture">
                    <div class="card-body ">
                        <p class="card-text">{{ $member->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Portugal</li>
                        <li class="list-group-item">
                            <span style="font-size: 1rem;"> </span>
                            <span class="badge badge-pill badge-success">games</span>
                            <span style="font-size: 1rem;"> </span>
                            <span class="badge badge-primary badge-pill">funny</span>
                            <span style="font-size: 1rem;"> </span>
                            <span class="badge badge-pill badge-danger">technology</span>
                        </li>
                    </ul>
                    <div class="card-footer">
                        <a href="tel:{{ $member->contact }}" class="card-link">Contact</a>
                        <a href="mailto:{{ $member->email }}" class="card-link">Email</a>
                    </div>
                </div>
                @if($isOwner)
                <div class="card border-danger mt-3 position-relative" style="margin: auto;
    max-width: 30em;">
                    <div class="text-danger card-body w-100">
                        <h4 class="card-title">Danger Zone</h4>
                        <div class="alert alert-danger" role="alert">Be careful, deleting your account will permanently erase all of your information, events and friends,
                            have this in mind when you walk out the plank :'(</div>
                        <a href="./index.html">
                            <button type="button" class="btn btn-outline-danger">Delete Account</button>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-5 ">
                <div class="dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header ">Friends</h5>
                    <ul class="list-group list-group-flush">
                        @if (sizeof($friends) == 0)
                        <li class="list-group-item p-0 pt-0 pb-0">
                            <div class="media m-2">
                                <div class="media-body mb-0">
                                    <p class="pl-2 mb-0 mt-1 font-italic">
                                        No one is here...
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endif
                        @foreach ($friends as $friend)
                        <li class="list-group-item p-0 pt-0 pb-0">
                            <div class="media m-2">
                                <img class="d-flex m-auto rounded-circle" src="@if($friend->image) {{ Storage::url($friend->image) }} @else {{ asset('img/person_placeholder.png') }} @endif" alt="Profile picture" style="width: 32px; height: 32px;">
                                <div class="media-body mb-0">
                                    <p class="pl-2 mb-0 mt-1">
                                        @if ($isOwner)
                                        <a class="btn btn-outline-danger float-right d-inline-block btn-sm" href="#">
                                            <i class="fas fa-user-times"></i>
                                        </a>
                                        @endif
                                        <a href="/profile/{{ $friend->id }}">{{ $friend->name }}</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection