@extends('layouts.app') 

@section('title', 'Notifications') 

@section('content')

<div class="container mt-3"> 
    <div class="card"> 
        <ul class="list-group list-group-flush"> 
            @if($notifNotSeen != null)
                @foreach($notifNotSeen as $notif)
                    @if($notif->id_event_invite != null)
                        <li class="list-group-item font-weight-bold bg-white">You were invited to participate in the event 
                            <a href="/event/{{ $notift->id_event_invite }}">{{ $notif->title }}</a>.
                            <input id="eventId" value="{{  $notif->id_event_invite  }}" hidden>
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success @if($notif->status=='Going'){{ 'active'}}@endif">Going</button>                             
                                <button type="button" class="btn btn-primary btn-outline-primary @if($notif->status=='Interested'){{ 'active'}}@endif">Interested</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger @if($notif->status=='NotGoing'){{ 'active'}}@endif">Not going</button>                             
                            </div>                         
                        </li> 
                    @elseif($notif->id_friend != null)
                        <li class="list-group-item font-weight-bold bg-white"> 
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success">Accept</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger">Ignore</button>                             
                            </div>                         
                            <a href="/profile/{{$notif->id_friend}}">{{$notif->friend_name}}</a> has sent you a friend request.
                        </li>  
                    @elseif($notif->id_event_change != null)                   
                        <li class="list-group-item font-weight-bold bg-white">The event you are 
                            @if($notif->status=='Going')
                                going,
                            @else
                                interested in,
                            @endif 
                            <a href="event/{{$notif->id_event_change}}">{{$notif->title}}</a>, changed its 
                            @if($notif->change == 'Location')
                                location to {{$notif->location}}.
                            @elseif($notif->change == 'Date')
                                date to {{$notif->date}}.
                            @else
                                name.
                            @endif
                            <input id="eventId" value="{{  $notif->id_event_change  }}" hidden>
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success @if($notif->status=='Going'){{ 'active'}}@endif">Going</button>                             
                                <button type="button" class="btn btn-primary btn-outline-primary @if($notif->status=='Interested'){{ 'active'}}@endif">Interested</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger @if($notif->status=='NotGoing'){{ 'active'}}@endif">Not going</button>                             
                            </div>                         
                        </li>    
                    @endif                 
                @endforeach
            @endif
            @if($notifSeen != null)
                @foreach($notifSeen as $notif)
                    @if($notif->id_event_invite != null)
                        <li class="list-group-item">You were invited to participate in the event 
                            <a href="/event/{{ $notift->id_event_invite }}">{{ $notif->title }}</a>.
                            <input id="eventId" value="{{  $notift->id_event_invite  }}" hidden>
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success @if($notif->status=='Going'){{ 'active'}}@endif">Going</button>                             
                                <button type="button" class="btn btn-primary btn-outline-primary @if($notif->status=='Interested'){{ 'active'}}@endif">Interested</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger @if($notif->status=='NotGoing'){{ 'active'}}@endif">Not going</button>                             
                            </div>                         
                        </li> 
                    @elseif($notif->id_friend != null)
                        <li class="list-group-item"> 
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success">Accept</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger">Ignore</button>                             
                            </div>                         
                            <a href="/profile/{{$notif->id_friend}}">{{$notif->friend_name}}</a> has sent you a friend request.
                        </li>  
                    @elseif($notif->id_event_change != null)                   
                        <li class="list-group-item">The event you are 
                        @if($notif->status=='Going')
                            going,
                        @else
                            interested in,
                        @endif 
                            <a href="event/{{$notif->id_event_change}}">{{$notif->title}}</a>, changed its 
                            @if($notif->change == 'Location')
                                location to {{$notif->location}}.
                            @elseif($notif->change == 'Date')
                                date to {{$notif->date}}.
                            @else
                                name.
                            @endif
                            <input id="eventId" value="{{  $notif->id_event_change  }}" hidden>
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Small button group"> 
                                <button type="button" class="btn btn-success btn-outline-success @if($notif->status=='Going'){{ 'active'}}@endif">Going</button>                             
                                <button type="button" class="btn btn-primary btn-outline-primary @if($notif->status=='Interested'){{ 'active'}}@endif">Interested</button>                             
                                <button type="button" class="btn btn-danger btn-outline-danger @if($notif->status=='NotGoing'){{ 'active'}}@endif">Not going</button>                             
                            </div>                         
                        </li>    
                    @endif                 
                @endforeach
            @endif                   
        </ul>                 
    </div>             
</div>        
@endsection