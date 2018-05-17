<li class="list-group-item p-0">
    <div class="container pb-0 pl-3 pt-2 pr-1">
        <img alt="Profile picture" src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55">
        <div class="float-right">
            <label class="mr-2">
                <i class="fas fa-comment text-primary"></i> 1
            </label>
            <label class="mr-2">
                <i class="fas fa-heart text-danger"> </i> 3
            </label>
            <label class="mr-2 text-primary">
                <i class="fas fa-times"></i>
            </label>
        </div>
        <h5>{{ $comment->name }}</h5>
        <p class="pr-1">{{ $comment->text }}</p>
    </div>
</li>  