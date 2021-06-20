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

<section class="space sub-header" style="background: url({{asset('public/frontend/images/sub-header-bg.png')}}) no-repeat #4d76ff;">
    <div class="container container-custom">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-slider">
                        <div class="banner mt-4">
                            <div class="main-title">
                                <h1 class="main-title-shahzad">
                                    "Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying"
                                </h1>
                            </div>
                        </div>
                        <div class="banner mt-4">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 d-flex align-items-center">
                                    <div class="main-title">
                                        <h1 class="main-title-shahzad">
                                            "Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying"
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banner mt-4">
                            <div class="row">
                                <div class="ccol-12 col-md-12 col-lg-12 d-flex align-items-center">
                                    <div class="main-title">
                                        <h1 class="main-title-shahzad">
                                            "Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying"
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>



<section class="space mt-5">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="news-img-block">
                    <img src="{{asset('public/frontend/images/selfie-2.png')}}" class="img-fluid w-100" alt="#" />
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="video-play-text">
                    <span>How to ___</span>
                    <h2>How We Work </h2>
                    <p>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                    </p>
                    <p>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                    </p>

    <!--                 <ul class="home-content-list">
                        <li>Patient Confidentiality</li>
                        <li>Case Style Guide</li>
                        <li>Why Upload a Case</li>
                        <li>Terms of Use</li>
                    </ul> -->

                </div>
            </div>
        </div>
    </div>
</section>

<section class="space">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <div class="sub-title_center text-left">
                    <h2>Our Specialist</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php 
                    for ($i=0; $i < 6 ; $i++) { ?>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                            <div class="docrtors-box1">
                                <img style="height: 200px;" src="{{asset('public/images/305536281.jpg')}}" class="img-fluid" alt="#">
                                <a href="{{url('')}}/{{ 'doctor-profile' }}"><h4>Dr. Lorum Ipsum</h4></a>
                                <p>Pakistan</p>
                                <div style="text-align: justify;">
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter.
                                </div>
                                <div class="bg-shade">
                                    <img src="{{asset('public/frontend/images/bg-shade.png')}}" class="img-fluid" alt="#">
                                </div>
                            </div>
                        </div>
                   <?php }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-5">
                    <a href="{{url('our-specialists')}}" class="btn btn-outline-primary">Browse All Specialists</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="space">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="news-img-block">
                    <br />
                    <br />
                    <br />
                    <img src="{{asset('public/frontend/images/group-hug.png')}}" class="img-fluid w-100" alt="#" />
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="video-play-text">
                    <h2>From Our Specialist</h2>
                    <br />
                    <p>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                    </p>
                    <p>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection