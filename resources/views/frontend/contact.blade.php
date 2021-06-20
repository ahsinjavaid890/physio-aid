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
<section class="space sub-header" style="background: url(../images/sub-header-bg.png) no-repeat #4565cf; ">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-6">
                <div class="sub-header_content">
                    <p>CONTACT US </p>
                    <h3>Reach out with your queries and we'll love to answer as soon as possible</h3>
                    <span><i>Home / Contact Us</i></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sub-header_main">
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="space mt-5">
        <div class="container container-custom">

            <div class="row">
                <div class="col-md-5">
                    <div class="contact-box">
                        
                        <div class="contact-title">
                            <h4>Contact Information</h4>
                            <i class="fa fa-phone-volume"></i>
                            <div class="contact-title_icon">
                                <p>Phone</p>
                                <h6>{{ DB::table('sitesettings')->where('id', 1)->first()->phoneno }}</h6>
                            </div>
                        </div>
                        <div class="contact-title">
                            <i class="fa fa-envelope"></i>
                            <div class="contact-title_icon">
                                <p>Email</p>
                                <h6><a href="https://demo.web3canvas.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="10797e767f507568717d607c753e737f7d">{{ DB::table('sitesettings')->where('id', 1)->first()->email }}</a></h6>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="contact-box">
                        <div class="contact-title">
                            <h4>Head Office</h4>
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="contact-title_icon">
                                <p>Location</p>
                                <h6>{{ DB::table('sitesettings')->where('id', 1)->first()->address }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="get-in-touch get-in-touch-style2">
                        <!-- <img src="{{asset('public/frontend/images/contact-form-bg.png')}}" class="img-fluid get-in-bg" alt="#"> -->
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <h3>Get in Touch with Us</h3>
                        <form action="{{ URL('submitcontactus') }}" method="POST" id="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                        <i class="far fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="phone" placeholder="Your Phone Number" >
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group textarea-icon">
                                        <textarea class="form-control" name="message" required placeholder="Your Message" id="" rows="3"></textarea>
                                        <i class="far fa-envelope"></i>
                                        <button type="submit" class="btn btn-success">BOOK NOW</button>
                                    </div>
                                </div>
                            </div>
                            <div id="result" class="text-white"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map mb-5">
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-12">
                    <iframe width="100%" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection