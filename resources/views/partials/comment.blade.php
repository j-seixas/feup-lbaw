<li class="list-group-item p-0">
    <div class="container pb-0 pl-3 pt-2 pr-1">
        <img alt="Profile picture" src="@if($comment->profile_pic) {{ Storage::url($comment->profile_pic) }} @else {{ asset('img/person_placeholder.png') }} @endif" class="mr-2 float-left rounded-circle" height="55" width="55">
        <div class="float-right">
            <label class="mr-2">
                <i class="fas fa-comment text-primary"></i> {{ $comment->num_comments}}
            </label>
            <label class="mr-2">
                <i class="fas fa-heart text-danger"> </i> {{ $comment->num_likes}}
            </label>
            @if(Auth::check() && (($role != "Participant" && $role != null) || Auth::user()->id == $comment->id_member))
            <label class="mr-2 text-primary">
                <i class="fas fa-times"></i>
            </label>
            @endif
        </div>
        <h5>{{ $comment->name }}</h5>
        <p class="pr-1">{{ $comment->text }}</p>
        @if(sizeof($comment->sub_comments) > 0)
            @foreach ($comment->sub_comments as $sub)
            <div class="container pr-0 pl-4">
                <img alt="Profile picture" src="@if($comment->profile_pic) {{ Storage::url($comment->profile_pic) }} @else {{ asset('img/person_placeholder.png') }} @endif" class="mr-2 float-left rounded-circle" height="55" width="55">
                <div class="float-right">
                    <label class="mr-2">
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