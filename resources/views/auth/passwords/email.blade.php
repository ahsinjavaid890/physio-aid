@extends('layouts.app')
@section('title')
<title>Forget Password</title>
@endsection
@section('content') 
<section class="mb-5 mb-special mt-50">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="get-in-touch">
                    <!-- <img src="images/contact-form-bg.png" class="img-fluid get-in-bg" alt="#"> -->
                    <h3>Forgot Password</h3>
                    <p>Please provide your registerd email and we'll forward you the details</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <strong style="color: red;">{{ $message }}</strong>
                                @enderror
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Recover</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
