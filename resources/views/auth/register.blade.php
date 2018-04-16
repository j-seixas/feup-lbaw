@extends('layouts.auth')

@section('form')
<form class="form-signin" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="text-center mb-4">
      <img class="mb-4" src="{{ asset('img/logo.svg') }}" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Eventually</h1>
      <p>Sign up to be able to participate in the community and create events!</p>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputFirstName" class="form-control" placeholder="First name" required autofocus>
      <label for="inputFirstName">First name</label>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputLastName" class="form-control" placeholder="Last name" required>
      <label for="inputLastName">Last name</label>
    </div>

    <div class="form-label-group">
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
      <label for="inputEmail">Email address</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <label for="inputPassword">Password</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confirm the password" required>
      <label for="inputPasswordConfirm">Confirm the password</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
  </form>
@endsection
