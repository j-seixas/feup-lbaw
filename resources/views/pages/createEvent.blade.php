@extends('layouts.app') 

@section('title', 'Home') 

@section('content')

<div class="container pt-3">
  <div class="card">
    <div class="card-header">Event Settings</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item ">
        @if($edit)
        <form method="POST" action="{{route('event',['id' => $event->id])}}" id="form1">
        @else
        <form method="POST" action="{{url('event')}}" id="form1">
        @endif
        {{ csrf_field() }}
          <div class="form-group">
            <label class="col-form-label" for="eventName">Event name
            </label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">Be creative! No one will want to join an event called 'My Event'.&nbsp;</label>
            @if($edit)
            <input type="text" class="form-control" id="eventName" name="eventName" value="{{ $event->title }}" required="required">
            @else
            <input type="text" class="form-control" id="eventName" name="eventName" required="required">
            @endif
          </div>
          <div class="form-group">
            <label class="col-form-label" for="eventDescription">Event description</label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">What is this event about? Make it simple, but effective!&nbsp;</label>
            @if($edit)
            <textarea class="form-control" id="eventDescription" name="eventDescription">{{ $event->description }}</textarea>
            @else
            <textarea class="form-control" id="eventDescription" name="eventDescription"></textarea>
            @endif
          </div>
          <div class="form-group">
            <label class="col-form-label">Privacy Settings</label>
            <label class="col-form-label pl-3 font-weight-light">Can anyone join this event? Or is it just you and your buddies?&nbsp;</label>
            <div class="row pl-3 pb-0">
              <div class="btn-group float-none" data-toggle="buttons">
                <label class="btn btn-secondary active">
                  <input type="radio" name="eventPrivacy" @if($edit && $event->visibility == "Public") checked="checked" @endif value="Public" required="required">
                  <i class="fas fa-users"></i> Public
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="eventPrivacy" @if($edit && $event->visibility == "Private") checked="checked" @endif value="Private">
                  <i class="fas fa-lock"></i> Private
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-form-label" for="eventDate">Date</label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">When is this Masterpiece happening?&nbsp;&nbsp;</label>
            <input type="date" class="form-control" id="eventDate" name="eventDate" style="max-width: 175px;" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="eventTime">Time</label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">At what time does it start? If it's the whole day just leave it at 12:00 AM.&nbsp;</label>
            <input type="time" class="form-control" id="eventTime" style="max-width: 175px;" required value="00:00">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="eventLocation">Location</label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">Where will the gathering take place?&nbsp;</label>
            @if($edit)
            <input type="text" class="form-control" id="eventLocation" name="eventLocation" value="{{ $event->location }}" required="required">
            @else
            <input type="text" class="form-control" id="eventLocation" name="eventLocation" required="required">
            @endif
          </div>
          <div class="form-group">
            <label class="col-form-label">Manage attendants</label>
            <label class="col-form-label pl-3 font-weight-light" for="eventName">Who is going to have the pleasure of joining?&nbsp;</label>
            <div class="row">
              <div class="col-md-4">
                <label class="col-form-label">Tags</label>
                <input class="form-control mr-sm-2" type="text" placeholder="Insert tag..." aria-label="Tags">
                <button class="btn btn-outline-secondary my-2 my-sm-0 mr-3" type="submit">Add</button>
                <div class="card mt-2">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>Pines</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>Plants</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>Sightseeing</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <label class="col-form-label">Participants</label>
                <input class="form-control mr-sm-2" type="text" placeholder="Insert user..." aria-label="Tags">
                <button class="btn btn-outline-secondary my-2 my-sm-0 mr-3" type="submit">Add</button>
                <div class="card mt-2">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>Friend 2</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>John Halmond</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>TheLegendary27</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>Daisy Rose</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-times"></i>
                            </label>João Lopes</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <label class="col-form-label">Friends</label>
                <div class="card">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-plus"></i>
                            </label>Friend 1</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-plus"></i>
                            </label>Friend 3</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-plus"></i>
                            </label>Friend 4</p>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item p-0 pt-0 pb-0">
                      <div class="media m-2">
                        <img class="d-flex m-auto" src="http://pinegrow.com/placeholders/img19.jpg" alt="Generic placeholder image" width="150" style="width: 32px;
    height: 32px;">
                        <div class="media-body mb-0">
                          <p class="pl-2 mb-0 mt-1">
                            <label style="float: right;" class="mr-2 text-primary pl-2">
                              <i class="fas fa-plus"></i>
                            </label>Friend 5</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </form>
      </li>
    </ul>
  </div>
  @if($edit)
  <button class="btn btn-primary mt-2 btn-lg" form="form1" type="submit" id="updateButton">Update your event</button>
  @else
  <button class="btn btn-primary mt-2 btn-lg" form="form1" type="submit">Create your event</button>
  @endif
</div>


@endsection