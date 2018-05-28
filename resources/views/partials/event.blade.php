<div class="col-md-4 pb-3">
    <div class="card">
        <img class="card-img-top" alt="Event image" src="@if($event->image) {{ Storage::url($event->image) }} @else {{ asset('img/event_placeholder.png') }} @endif" />
        <div class="card-body">
            <h4 class="card-title">{{ $event->title }}</h4>
            <div class="h5">{{ $event->time }}</div>
            <p class="card-text">{{ $event->description }}</p>
            <a class="btn btn-primary" href="/event/{{ $event->id }}" role="button">Check this event</a>
        </div>
        <div class="card-footer">{{ $event->location }}</div>
    </div>
</div>