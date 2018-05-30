@extends('layouts.auth')

@section('form')
<form class="form-signin" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}
  <div class="text-center mb-4">
    <img class="mb-4" src="{{ asset('img/logo.svg') }}" alt="Eventually logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Eventually</h1>
    <p>Sign in to come back to the community and participate in events!</p>
  </div>

  @if ($errors->has('email'))
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('email') }}
  </div>
  @endif

  @if ($errors->has('password'))
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('password') }}
  </div>
  @endif

  <div class="form-label-group">
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
    <label for="inputEmail">Email address</label>
  </div>

  <div class="form-label-group">
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <label for="inputPassword">Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input name="remember" type="checkbox" value="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
</form>
@endsection
