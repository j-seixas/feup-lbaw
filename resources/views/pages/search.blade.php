@extends('layouts.app')

@section('title', 'Search results')

@section('content')

<div class="container" id="searchContainer">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="/search?query={{ $query }}" class="list-group-item list-group-item-action @if($type == 'event') active @endif">
                    Events
                    <span class="badge badge-light badge-pill float-right">{{ sizeof($events) }}</span>
                </a>
                <a href="/search?query={{ $query }}&amp;type=member" class="list-group-item list-group-item-action @if($type == 'member') active @endif">
                    Users
                    <span class="badge badge-light badge-pill float-right">{{ sizeof($members) }}</span>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <div>
                <div class="justify-content-between d-flex pb-2">
                    <h5 class="align-self-center"> @if($type == 'event') {{ sizeof($events) }} @elseif($type == 'member') {{ sizeof($members) }} @endif result(s) found for "{{ $query }}"</h5>
                    {{--<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-outline-primary active">
                            <i class="fas fa-sort-amount-down"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary">
                            <i class="fas fa-sort-amount-up"></i>
                        </button>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by&nbsp;</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">People Going</a>
                                <a class="dropdown-item" href="#">Date</a>
                            </div>
                        </div>
                    </div>--}}
                </div>
                <div class="list-group">
                    @if($type == 'event')
                    @foreach($events as $event)
                    <a href="/event/{{ $event->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $event->title }}</h5>
                            <small class="text-muted">{{ $event->date }}</small>
                        </div>
                        <p class="mb-1">{{ $event->description }}</p>
                        <small>{{ $event->visibility }}.</small>
                        <small class="text-muted">28 people going.</small>
                    </a>
                    @endforeach
                    @endif
                    @if($type == 'member')
                    @foreach($members as $member)
                    <li class="list-group-item p-0 pt-0 pb-0">
                        <div class="media m-2">
                            <img class="d-flex m-auto rounded-circle" src="@if($member->image) {{ Storage::url($member->image) }} @else {{ asset('img/person_placeholder.png') }} @endif" alt="Profile picture" style="width: 32px; height: 32px;">
                            <div class="media-body mb-0">
                                <p class="pl-2 mb-0 mt-1">
                                    <a href="/profile/{{ $member->id }}">{{ $member->name }}</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection