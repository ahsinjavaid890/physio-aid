@extends('layouts.app')
@section('title')
<title>{{ $data->tittle }}</title>
<meta name="DC.Title" content="{{ $data->tittle }}">
<meta name="rating" content="general">
<meta name="description" content="{{ $data->blogshortdescription }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ url('public/images') }}/{{ $data->image }}">
<meta property="og:title" content="{{ $data->tittle }}">
<meta property="og:description" content="{{ $data->blogshortdescription }}">
<meta property="og:site_name" content="TopAtLaw">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<section class="space">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-list">
                    <img src="{{ url('public/images') }}/{{ $data->image }}" class="img-fluid" alt="{{ $data->tittle }}">
                    <div class="blog-date">
                        <h3>{{ date('d', strtotime($data->created_at)) }}</h3>
                        <span>{{ date('M', strtotime($data->created_at)) }}</span>
                    </div>
                    <div class="blog-text-wrap">
                        <div class="blog-comment-top">
                            <p><i class="far fa-user"></i>Admin </p>
                        </div>
                        <h3>{{ $data->tittle }}</h3>
                        <p>{{ $data->blog }}</p>
                      
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-sidebar">
                    <div class="blog-sidebar_heading">
                        <h4>Search</h4>
                    </div>
                    <div class="blog-sidebar_wrap">
                        <div class="blog-sidebar_content blog-sidebar_search">
                            <form action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search here" id="exampleFormControlInput1">
                                    <i class="fas fa-search"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="blog-sidebar">
                    <div class="blog-sidebar_heading">
                        <h4>Popular Posts</h4>
                    </div>
                    <div class="blog-sidebar_wrap">

                        @foreach($blogs as $r)
                        <div class="blog-sidebar_content">
                            <a href="{{ url('') }}/{{ $r->url }}" class="thumbnail-wrap">
                                <img src="{{ url('public/images') }}/{{ $r->image }}" alt="#">
                                <div class="thumbnail-hover">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                            </a>
                            <div class="thumbnail-text_wrap">
                                <p>{{ $r->tittle }}
                                </p>
                                <span>{{ date('M d,Y', strtotime($data->created_at)) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
               
                <div class="blog-join_us">
                    <div class="blog-join_us-content">
                        <h6>AD BANNER</h6>
                        <h3>JOIN US</h3>
                        <p>Lorem ipsum dolor sit amet conse</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection