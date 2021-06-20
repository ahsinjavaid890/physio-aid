@extends('layouts.app')
@section('title')
<title>Reset Password</title>
@endsection
@section('content')
<section class="mb-5 mb-special mt-50">
<div class="container container-custom">
    <div class="row">
        <div class="col-md-6 offset-md-2 col-lg-6 offset-lg-3">
            <div class="get-in-touch">
                <!-- <img src="images/contact-form-bg.png" class="img-fluid get-in-bg" alt="#"> -->
                <h3>Reset Password</h3>
                @if(session()->has('error'))
                    <div style="text-align: center;color: red;" id="result">{{ session()->get('error') }}</div>
                @endif
                <br>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label>{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection