@extends('auth.auth-layout')
@section('page-title', 'Reset Password - Online Sales And Expanse Management')
@section('form-title', 'Reset Password')
@section('auth-content')
    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="form-group mb-3">
                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New password" >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror " name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Reset Password') }}</button>
        </form>
    </div>
@endsection
