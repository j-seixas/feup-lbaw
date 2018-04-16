@extends('layouts.auth')

@section('form')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="text-center mb-4">
      <img class="mb-4" src="{{ asset('img/logo.svg') }}" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Eventually</h1>
      <p>Sign in to come back to the community and participate in events!</p>
    </div>

    <div class="form-label-group">
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
      <label for="inputEmail">Email address</label>
    </div>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <div class="form-label-group">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <label for="inputPassword">Password</label>
    </div>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me" {{ old('remember') ? 'checked' : '' }}> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
  </form>
</form>
@endsection
