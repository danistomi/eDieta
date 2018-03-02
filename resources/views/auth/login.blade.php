@extends('layouts.app')

@section('content')
    <form method="post" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                   id="username"
                   aria-describedby="usernameError">
            @if ($errors->has('username'))
                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   id="password">
            @if($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
            <label class="form-check-label" for="rememberMe" {{ old('remember') ? 'checked' : ''}}>Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">
            Forgot Your Password?
        </a>
    </form>
@endsection
