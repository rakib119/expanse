@extends('auth.auth-layout')
@section('page-title', 'Login - Online Sales And Expanse Management')
@section('form-title', 'Please enter your user information.')
@section('auth-content')
    <div class="card-body"> 
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-2">
                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}> <span class="custom-control-label">Remember Me</span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </form>
    </div>
    @if (Route::has('password.request'))
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered d-inline-block ">
                <a class="footer-link" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }} </a>
            </div>
        </div>
    @endif
@endsection
