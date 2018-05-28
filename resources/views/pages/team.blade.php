@extends('layouts.app')

@section('title', 'Team')

@section('content')

<div class="jumbotron">
    <div class="container">
        <h3 class="display-4">Team</h3>
        <p> Our team consist of these specially trained monkeys.</p>
    </div>
    <div class="card-deck">
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="https://avatars2.githubusercontent.com/u/19241121?s=400&v=4">
            <div class="card-body">
                <h4 class="card-title">João Seixas</h4>
                <p class="card-text">Palha</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="https://avatars3.githubusercontent.com/u/25772341?s=460&v=4">
            <div class="card-body">
                <h4 class="card-title">José Freixo</h4>
                <p class="card-text">Amante de Pokémons.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="https://avatars2.githubusercontent.com/u/6492427?s=400&v=4">
            <div class="card-body">
                <h4 class="card-title">Rafael Damasceno</h4>
                <p class="card-text">Palha</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="https://avatars1.githubusercontent.com/u/19344861?s=400&v=4">
            <div class="card-body">
                <h4 class="card-title">Tiago Carvalho</h4>
                <p class="card-text">Palha</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
</div>

@endsection