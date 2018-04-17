@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="jumbotron">
    <div class="container">
        <h3 class="display-4">Team</h3>
        <p> Our team consist of these specially trained monkeys.</p>
    </div>
    <div class="card-deck">
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img15.jpg">
            <div class="card-body">
                <h4 class="card-title">João Seixas</h4>
                <p class="card-text">Palha</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img15.jpg">
            <div class="card-body">
                <h4 class="card-title">José Freixo</h4>
                <p class="card-text">Amante de Pokémons.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img14.jpg">
            <div class="card-body">
                <h4 class="card-title">Rafael Damasceno</h4>
                <p class="card-text">Palha</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" alt="Card image cap" src="http://pinegrow.com/placeholders/img13.jpg">
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