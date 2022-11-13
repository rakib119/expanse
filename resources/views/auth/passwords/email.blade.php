@extends('auth.auth-layout')
@section('page-title', 'Reset Password - Online Sales And Expanse Management')
@section('form-title', 'Please enter your email Addrss.')
@section('auth-content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group mb-3">
                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">{{ __('Send Password Reset Link') }}</button>
        </form>
    </div>
    
@endsection
