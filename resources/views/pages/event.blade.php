@extends('layouts.app') 

@section('title', 'Home') 

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
                        <button type="button" class="btn btn-outline-danger ml-1" id="deleteButton"> 
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
                                                                         
                    <li class="list-group-item p-0">
                        <div class="container pb-0 pl-3 pt-2 pr-1">
                            <img alt="Profile picture" src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55">
                            <div class="float-right">
                                <label class="mr-2">
                                    <i class="fas fa-comment text-primary"></i> 0
                                </label>
                                <label class="mr-2">
                                    <i class="fas fa-heart text-danger"> </i> 3
                                </label>
                                <label class="mr-2 text-primary">
                                    <i class="fas fa-times"></i>
                                </label>
                            </div>
                            <h5>Rocky Balboa</h5>
                            <p class="pr-1">Do you think the weather will affect?</p>
                            <div class="container mb-3">
                                <div class="row mb-1">
                                    <div class="col-4 p-0">
                                        <p class="float-left m-0">I don't think so</p>
                                    </div>
                                    <div class="col-8">
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-4 p-0">
                                        <p class="float-left m-0">Maybe??</p>
                                    </div>
                                    <div class="col-8">
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 9%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-4 p-0">
                                        <p class="float-left m-0">¯\_(ツ)_/¯</p>
                                    </div>
                                    <div class="col-8">
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 6%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-0">
                        <div class="container pb-0 pl-3 pt-2 pr-1">
                            <img alt="Profile picture" src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55">
                            <div class="float-right">
                                <label class="mr-2">
                                    <i class="fas fa-comment text-primary"></i> 0
                                </label>
                                <label class="mr-2">
                                    <i class="fas fa-heart text-danger"> </i> 3
                                </label>
                                <label class="mr-2 text-primary">
                                    <i class="fas fa-times"></i>
                                </label>
                            </div>
                            <h5>Rocky Balboa</h5>
                            <p class="pr-1">This is the growing steps of pines</p>
                            <div class="container">
                                <p style="font-size: 60px;" class="float-left"><i class="far fa-file"></i> </p>
                                <p class="pr-1 pl-5 ml-3 mb-0 pt-4">pines.txt</p>
                                <button type="button" class="btn btn-outline-primary float-right btn-sm">
                                    <i class="fas fa-download"></i> Download
                                </button>
                                <p class="pr-1 pl-5 ml-3 pt-1">256 KB</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>                     
        </div>
    </div>
</div>

@endsection