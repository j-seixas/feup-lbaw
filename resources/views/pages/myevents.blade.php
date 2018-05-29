@extends('layouts.app') 

@section('title', 'My Events') 

@section('content')
<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="created-tab" data-toggle="tab" href="#created" role="tab" aria-controls="created" aria-selected="true">
          Created <span class="badge badge-light">{{sizeof($createdEvents)}}</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="going-tab" data-toggle="tab" href="#going" role="tab" aria-controls="going" aria-selected="false">
          Going <span class="badge badge-light">{{sizeof($goingEvents)}}</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="invited-tab" data-toggle="tab" href="#invited" role="tab" aria-controls="invited" aria-selected="false">
          Invited <span class="badge badge-light">{{sizeof($invitedEvents)}}</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="false">
          Past <span class="badge badge-light">{{sizeof($pastEvents)}}</span> 
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="created" role="tabpanel" aria-labelledby="created-tab">
        @if($createdEvents == null)
            <p class="text-muted text-center font-italic">Hmmmm... Try creating an event...</p>
        @else
            <div class="list-group">
                @foreach($createdEvents as $event)
                    <a href="/event/{{ $event->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $event->title }}</h5>
                            <small class="text-muted">{{ $event->date }}</small>
                        </div>
                        <p class="mb-1">{{ $event->description }}</p>
                        <small>{{ $event->visibility }}.</small>
                        <small class="text-muted">{{ $event->num_going }} people going.</small>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="tab-pane fade" id="going" role="tabpanel" aria-labelledby="going-tab">
        @if($goingEvents == null)
            <p class="text-muted text-center font-italic">Are you sure you don't wanna go to an event?</p>
        @else
            <div class="list-group">
                @foreach($goingEvents as $event)
                    <a href="/event/{{ $event->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $event->title }}</h5>
                            <small class="text-muted">{{ $event->date }}</small>
                        </div>
                        <p class="mb-1">{{ $event->description }}</p>
                        <small>{{ $event->visibility }}.</small>
                        <small class="text-muted">{{ $event->num_going }} people going.</small>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="tab-pane fade" id="invited" role="tabpanel" aria-labelledby="invited-tab">
        @if($invitedEvents == null)
            <p class="text-muted text-center font-italic">Bummer... Guess you weren't invited for any event.</p>  
        @else
            <div class="list-group">
                @foreach($invitedEvents as $event)
                    <a href="/event/{{ $event->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $event->title }}</h5>
                            <small class="text-muted">{{ $event->date }}</small>
                        </div>
                        <p class="mb-1">{{ $event->description }}</p>
                        <small>{{ $event->visibility }}.</small>
                        <small class="text-muted">{{ $event->num_going }} people going.</small>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
        @if($pastEvents == null)
            <p class="text-muted text-center font-italic">Oh, the great memories you will have!</p>
        @else
            <div class="list-group">
                @foreach($pastEvents as $event)
                    <a href="/event/{{ $event->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $event->title }}</h5>
                            <small class="text-muted">{{ $event->date }}</small>
                        </div>
                        <p class="mb-1">{{ $event->description }}</p>
                        <small>{{ $event->visibility }}.</small>
                        <small class="text-muted">{{ $event->num_going }} people going.</small>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection