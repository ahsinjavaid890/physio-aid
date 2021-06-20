@extends('layouts.app')
@section('title')
<title>Login</title>
<meta name="DC.Title" content="ORIF - Bringing Bones Together">
<meta name="rating" content="general">
<meta name="description" content="Uploading images and case data to the catalogue is quick and uncomplicated. First you'll need to log in, then click above to upload images directly from your smartphone or desktop. Provide some case details (see the syle guide for tips) and you're done.">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ asset('public/frontend/images/logo-mine.png') }}">
<meta property="og:title" content="ORIF - Bringing Bones Together">
<meta property="og:description" content="Uploading images and case data to the catalogue is quick and uncomplicated. First you'll need to log in, then click above to upload images directly from your smartphone or desktop. Provide some case details (see the syle guide for tips) and you're done.">
<meta property="og:site_name" content="TopAtLaw">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<section class="mb-5 mb-special mt-50">
<div class="container container-custom">
    <div class="row">
        <div class="col-md-5 offset-md-4 col-lg-5 offset-lg-4">
            <div class="get-in-touch">
                <!-- <img src="images/contact-form-bg.png" class="img-fluid get-in-bg" alt="#"> -->
                <h3>Login</h3>
                @if(session()->has('error'))
                    <div style="text-align: center;color: red;" id="result">{{ session()->get('error') }}</div>
                @endif
                <br>
                <form action="{{ route('login') }}" method="POST" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" value="@if(session()->has('email')){{ session()->get('email') }}  @endif" class="form-control" name="email" placeholder="Enter Email" required>
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 text-right">
                          <a href="{{url('forgot-password')}}" class="link-href"> <small>Forget Password?</small> </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Login Now</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-12 text-center">
                        <p>Don't have an account ? <a href="{{url('signup')}}" class="link-href"> Signup</a></p>
                      </div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection