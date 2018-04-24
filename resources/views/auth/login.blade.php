@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-5 text-center mt-3"><h3>Login</h3></div>
        <div class="row">
            <div class="form-signin">
                <form method="post" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               id="email"
                               aria-describedby="usernameError" required autofocus>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-label-group">
                        <label for="password">Password</label>
                        <input name="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               id="password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe" {{ old('remember') ? 'checked' : ''}}>Remember
                            me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <a class="btn btn-link btn-block" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
