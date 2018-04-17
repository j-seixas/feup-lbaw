@extends('layouts.app') 

@section('title', 'Home') 

@section('content')

<div class="container pr-null pb-null pl-null pt-3">
    <div class="row">
        <div class="col-md-7 pb-3">
            <div class="card">
                <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img20.jpg">
                <div class="card-body">
                    <h4 class="card-title">{{ $event->title }}</h4>
                    <div class="h5">{{ $event->time }}</div>
                    <p class="card-text">{{ $event->description }}</p>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-success">Going</button>
                        <button type="button" class="btn btn-outline-primary">Interested</button>
                        <button type="button" class="btn btn-outline-danger flex-wrap">Not going</button>
                    </div>
                    <p class="card-text" style="padding-top: 8px;">13 people going.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $event->location }}</li>
                    <li class="list-group-item"> 
                        <span style="font-size: 1rem;"> </span> 
                        <span class="badge badge-pill badge-success">pines</span> 
                        <span style="font-size: 1rem;"> </span> 
                        <span class="badge badge-primary badge-pill">plants</span> 
                        <span style="font-size: 1rem;"> </span> 
                        <span class="badge badge-pill badge-danger">sightseeing</span> 
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-5"> 
            <div class="card"> 
                <div class="card-header bg-white"> 
                    <input type="text" class="form-control" placeholder="Comment..."> 
                    <button type="button" class="btn btn-secondary mt-2 mr-2" style="margin-top: 1;">
                       <i class="fas fa-chart-pie"></i>Add poll
                    </button>                             
                    <button type="button" class="btn btn-secondary mt-2" style="margin-top: 1;">
                        <i class="fas fa-file"></i>Add file
                    </button>                             
                </div>                         
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item p-0"> 
                        <div class="container pb-0 pl-3 pt-2 pr-1"> 
                            <img src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55"> 
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
                            <h5>Rocky Balboa</h5> 
                            <p class="pr-1">Watching pines? More like fighting them Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet.</p> 
                            <div class="container pr-0 pl-4"> 
                                <img src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55"> 
                                <div class="float-right"> 
                                    <label class="mr-2"> 
                                        <i class="fas fa-heart text-danger"> </i> 3
                                    </label>                                             
                                    <label class="mr-2 text-primary"> 
                                        <i class="fas fa-times"></i> 
                                    </label>                                             
                                </div>                                         
                                <h5>Rocky Balboa</h5> 
                                <p class="pr-1">Watching pines? More like fighting them Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet.</p> 
                            </div>                                     
                        </div>                                 
                    </li>                             
                    <li class="list-group-item p-0"> 
                        <div class="container pb-0 pl-3 pt-2 pr-1"> 
                            <img src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55"> 
                            <div class="float-right"> 
                                <label class="mr-2">
                                    <i class="fas fa-comment text-primary"></i>0
                                </label>                                         
                                <label class="mr-2"> 
                                    <i class="fas fa-heart text-danger"> </i> 3
                                </label>                                         
                                <label class="mr-2 text-primary"> 
                                    <i class="fas fa-times"></i> 
                                </label>                                         
                            </div>                                     
                            <h5>Rocky Balboa</h5> 
                            <p class="pr-1">Watching pines? More like fighting them Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est.</p> 
                        </div>                                 
                    </li>                             
                    <li class="list-group-item p-0"> 
                        <div class="container pb-0 pl-3 pt-2 pr-1"> 
                            <img src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55"> 
                            <div class="float-right"> 
                                <label class="mr-2">
                                    <i class="fas fa-comment text-primary"></i>0
                                </label>                                         
                                <label class="mr-2"> 
                                    <i class="fas fa-heart text-danger"> </i> 3
                                </label>                                         
                                <label class="mr-2 text-primary"> 
                                    <i class="fas fa-times"></i> 
                                </label>                                         
                            </div>                                     
                            <h5>Rocky Balboa</h5> 
                            <p class="pr-1">Do you think the Nazis did well?</p>
                            <div class="container mb-3">
                                <div class="row mb-1">
                                    <div class="col-4 p-0">
                                        <p class="float-left m-0">Hell yeah man</p> 
                                    </div>
                                    <div class="col-8">
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                        </div>                                                 
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-4 p-0">
                                        <p class="float-left m-0">Dude wtf??</p> 
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
                </ul>                         
            </div>                     
        </div>
    </div>
</div>

@endsection