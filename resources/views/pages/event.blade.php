@extends('layouts.app') 

@section('title', 'Home') 

@section('content')

<div class="container pr-null pb-null pl-null pt-3">
    <div class="row">
        <div class="col-md-7 pb-3">
            <div class="card">
                <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img20.jpg">
                <div class="card-body">
                    @if($isOwner)
                    <div class="float-right col-sm-auto pr-0 pl-0 pb-2"> 
                        <button type="button" class="btn btn-outline-primary"> 
                            <i class="fas fa-edit"></i> Edit
                        </button>                                 
                        <button type="button" class="btn btn-outline-danger ml-1"> 
                            <i class="fas fa-trash-alt"></i> Delete event
                        </button>                                                              
                    </div> 
                    @endif

                    <h4 class="card-title">{{ $event->title }}</h4>
                    <div class="h5">{{ $event->date }}</div>
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
                        <svg class="svg-inline--fa fa-chart-pie fa-w-18" aria-hidden="true" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M288 12.3V240h227.7c6.9 0 12.3-5.8 12-12.7-6.4-122.4-104.5-220.6-227-227-6.9-.3-12.7 5.1-12.7 12zM552.7 288c6.9 0 12.3 5.8 12 12.7-2.8 53.2-23.2 105.6-61.2 147.8-4.6 5.1-12.6 5.4-17.5.5L325 288h227.7zM401 433c4.8 4.8 4.7 12.8-.4 17.3-42.6 38.4-99 61.7-160.8 61.7C107.6 511.9-.2 403.8 0 271.5.2 143.4 100.8 38.9 227.3 32.3c6.9-.4 12.7 5.1 12.7 12V272l161 161z"></path>
                        </svg>
                        <!-- <i class="fas fa-chart-pie"></i> -->                                                                                                 Add poll
                    </button>
                    <button type="button" class="btn btn-secondary mt-2" style="margin-top: 1;">
                        <svg class="svg-inline--fa fa-file fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 384 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm160-14.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path>
                        </svg>
                        <!-- <i class="fas fa-file"></i> -->                                                                                                 Add file
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
                                    <svg class="svg-inline--fa fa-comment fa-w-18 text-primary" aria-hidden="true" data-prefix="fas" data-icon="comment" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M576 240c0 115-129 208-288 208-48.3 0-93.9-8.6-133.9-23.8-40.3 31.2-89.8 50.3-142.4 55.7-5.2.6-10.2-2.8-11.5-7.7-1.3-5 2.7-8.1 6.6-11.8 19.3-18.4 42.7-32.8 51.9-94.6C21.9 330.9 0 287.3 0 240 0 125.1 129 32 288 32s288 93.1 288 208z"></path>
                                    </svg>
                                    <!-- <i class="fas fa-comment text-primary"></i> -->                                                                                                                                         0
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
                            <img src="https://images.unsplash.com/photo-1499651681375-8afc5a4db253?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjIwOTIyfQ&s=eadad6ab3e4b92c6066ee4bfa73e9cc7q=85&fm=jpg&crop=faces&cs=srgb&w=100&h=100&fit=crop" class="mr-2 float-left rounded-circle" height="55" width="55">
                            <div class="float-right">
                                <label class="mr-2">
                                    <svg class="svg-inline--fa fa-comment fa-w-18 text-primary" aria-hidden="true" data-prefix="fas" data-icon="comment" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M576 240c0 115-129 208-288 208-48.3 0-93.9-8.6-133.9-23.8-40.3 31.2-89.8 50.3-142.4 55.7-5.2.6-10.2-2.8-11.5-7.7-1.3-5 2.7-8.1 6.6-11.8 19.3-18.4 42.7-32.8 51.9-94.6C21.9 330.9 0 287.3 0 240 0 125.1 129 32 288 32s288 93.1 288 208z"></path>
                                    </svg>
                                    <!-- <i class="fas fa-comment text-primary"></i> -->                                                                                                                                                                                         0
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