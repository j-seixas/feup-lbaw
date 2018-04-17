<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img17.jpg" />
        <div class="card-body">
            <h4 class="card-title">{{ $event->title }}</h4>
            <div class="h5">{{ $event->time }}</div>
            <p class="card-text">{{ $event->description }}</p>
            <a class="btn btn-primary" href="#" role="button">Check this event</a>
        </div>
        <div class="card-footer">{{ $event->location }}</div>
    </div>
</div>