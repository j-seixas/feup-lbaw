@extends('layouts.app') 

@section('title', $event->title) 

@section('content')

<div class="container pr-null pb-null pl-null pt-3">
    <div class="row">
        <div class="col-md-7 pb-3">
            <div class="card">
                <img class="card-img-top" alt="Event image" src="@if($event->image) {{ Storage::url($event->image) }} @else {{ asset('img/event_placeholder.png') }} @endif">
                <div class="card-body">
                    @if($isOwner)
                    <div class="float-right col-sm-auto pr-0 pl-0 pb-2"> 
                        <a class="btn btn-outline-primary" href="/event/{{  $event->id  }}/edit"> 
                            <i class="fas fa-edit"></i> Edit
                        </a>                                 
                        <button type="button" class="btn btn-outline-danger ml-1" id="eventDeleteButton"> 
                            <i class="fas fa-trash-alt"></i> Delete event
                        </button>                                                              
                    </div> 
                    @endif

                    <h4 class="card-title">{{ $event->title }}</h4>
                    <div class="h5">{{ $event->date }}</div>
                    <p class="card-text">{{ $event->description }}</p>
                    <input id="eventId" value="{{  $event->id  }}" hidden>
                    @if(Auth::check())
                    <div class="btn-group" role="group" aria-label="Attendance">
                        <button type="button" id="GoingButton" class="btn btn-outline-success attendanceButton @if($status == 'Going') active @endif" value="Going">Going</button>
                        <button type="button" id="InterestedButton" class="btn btn-outline-primary attendanceButton @if($status == 'Interested') active @endif" value="Interested">Interested</button>
                        <button type="button" id="NotGoingButton" class="btn btn-outline-danger flex-wrap attendanceButton @if($status == 'NotGoing') active @endif" value="NotGoing">Not going</button>                        
                    </div>
                    @endif
                    <p class="card-text" style="padding-top: 8px;"><span id="participants">{{ $participants }}</span> going. <span id="interested">{{ $interested }}</span> interested.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $event->location }}</li>
                    <li class="list-group-item">
                        @unless(sizeof($eventTags))
                        <p class="text-muted font-italic mb-0">Tags are missing. You should call the tag police!</p>
                        @endunless
                        @foreach ($eventTags as $tag)
                        <span style="font-size: 1rem;"> </span> 
                        <span class="badge badge-primary badge-pill">{{ $tag->name_tag }}</span>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-5"> 
            <div class="card">
                <div class="card-header bg-white">
                    <input type="text" class="form-control" placeholder="Comment...">
                    <button type="button" class="btn btn-secondary mt-2 mr-2">
                        <i class="fas fa-chart-pie"></i> Add poll
                    </button>
                    <button type="button" class="btn btn-secondary mt-2">
                        <i class="fas fa-file"></i> Add file
                    </button>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach($comments as $comment)
                        @include('partials.comment')
                    @endforeach                                                                    
                </ul>
            </div>                     
        </div>
    </div>
</div>

@endsection