@extends('layouts.app')
@section('title')
<title>Our Blogs</title>
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
                    <p>Our Blogs </p>
                    <h3>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in </h3>
                    <span><i>Home / Our Blogs</i></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sub-header_main">
                    <h2>Our Blogs</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="space mt-5">
        <div class="container container-custom">
            <div class="row">
                @foreach($data as $r)
                <div class="col-md-4">
                    <div class="blog-grid-wrap">
                        <div class="blog-grid-img">
                            <img src="{{ url('public/images') }}/{{ $r->image }}" class="img-fluid" alt="#">
                        </div>
                        <div class="blog-grid_content">
                            <div class="blog-grid_text">
                                <a href="{{ url('') }}/{{ $r->url }}">
                                    <h4>{{ $r->tittle }}</h4>
                                </a>
                                <p> {!! Str::limit($r->blogshortdescription, 150) !!}</p>
                            </div>
                            <div class="blog-grid-top_icon">
                                <small>{{ date('d M Y', strtotime($r->created_at)) }}</small>
                                <p><i class="far fa-eye"></i>233 <span>|</span> <i class="far fa-comment"></i>33</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection