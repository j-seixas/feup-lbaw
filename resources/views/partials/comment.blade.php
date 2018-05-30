<li class="list-group-item p-0">
    <div class="container pb-3 pl-3 pt-3 pr-1">
        <img alt="Profile picture" src="@if($comment->profile_pic) {{ Storage::url($comment->profile_pic) }} @else {{ asset('img/person_placeholder.png') }} @endif" class="mr-2 float-left rounded-circle" height="55" width="55">
        <div class="float-right">
            <label class="mr-2">
                <i class="fas fa-comment text-primary"></i> {{ $comment->num_comments}}
            </label>
            <input value="{{$comment->id}}" hidden>
            <label class="@if($comment->liked){{'liked'}}@endif mr-2 likeButton">
                <i class="@if($comment->liked) {{'fas '}} @else {{'far '}}@endif fa-heart text-danger"> </i> {{ $comment->num_likes}}
            </label>
            @if(Auth::check() && (($role != "Participant" && $role != null) || Auth::user()->id == $comment->id_member))
            <label class="mr-2 text-primary">
                <i class="fas fa-times"></i>
            </label>
            @endif
        </div>
        <h5>{{ $comment->name }}</h5>
        <p class="pr-1 mb-0">{{ $comment->text }}</p>
        @if($comment->path != null)
            <div class="container pb-4 pl-0 pt-1 pr-1 row justify-content-end">
                <button type="button" class="btn btn-outline-primary btn-sm ">
                    <i class="fas fa-download"></i> {{ $comment->path }}
                </button>
            </div>
        @elseif($comment->poll_options != null)
            <div class="container pt-3 p-0">
            @foreach($comment->poll_options as $option)
                <div class="row mb-1 align-items-center">
                    <div class="col-4">
                        <p class="m-0">{{ $option->option_text }}</p>
                    </div>
                    <div class="col-8">
                    
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                            aria-valuenow="@if($option->total_votes == 0){{0}}@else{{$option->num_votes / $option->total_votes * 100}}@endif"
                            aria-valuemin="0" aria-valuemax="100" 
                            style="width:@if($option->total_votes == 0){{0}}@else{{$option->num_votes / $option->total_votes * 100}}@endif%;">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
        @if(sizeof($comment->sub_comments) > 0)
            @foreach ($comment->sub_comments as $sub)
            <div class="container pr-3 pl-4  border-left">
                <img alt="Profile picture" src="@if($comment->profile_pic) {{ Storage::url($comment->profile_pic) }} @else {{ asset('img/person_placeholder.png') }} @endif" class="mr-2 float-left rounded-circle" height="55" width="55">
                <div class="float-right">
                    <input value="{{$comment->id}}" hidden>
                    <label class="@if($comment->liked){{'liked'}}@endif mr-2 likeButton">
                        <i class="fas fa-heart text-danger"> </i> {{ $sub->num_likes }}
                    </label>
                    @if(Auth::check() && (($role != "Participant" && $role != null) || Auth::user()->id == $sub->id_member))
                    <label class="mr-2 text-primary">
                        <i class="fas fa-times"></i>
                    </label>
                    @endif
                </div>
                <h5>{{ $sub->name }}</h5>
                <p class="pr-1">{{ $sub->text }}</p>
            </div>
            @endforeach
        @endif
    </div>
</li>
