@extends('layouts.app')
@section('title')
<title>ORIF - Bringing Bones Together</title>
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
            <div class="col-md-4 offset-md-4 col-lg-4 offset-lg-4">
                <div class="get-in-touch">
                    <!-- <img src="images/contact-form-bg.png" class="img-fluid get-in-bg" alt="#"> -->
                    <h3>Forgot Password</h3>
                    <p>Please provide your registerd email and we'll forward you the details</p>
                    <form action="#" method="POST" id="form">
                        <input type="hidden" name="apikey" value="YOUR_ACCESS_KEY_HERE">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="first name" placeholder="Enter Email" required>
                                    <i class="fa fa-envelope"></i>
                                </div>
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