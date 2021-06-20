@extends('layouts.app')
@section('title')
<title>Our Specialist</title>
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
<section class="about-section mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="sub-title_center">
                <span>___ Search Our Specialist___</span>
                <h2>From Thousands of Specialist</h2>
            </div>
        </div>
    </div>
</section>
<section class="about-section mt-5">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <ul class="booking-form">
                    <li><input type="text" id="casename" class="form-control" placeholder="Search by Keyword" /></li>
                    <li>
                        <select class="form-control select2 select2-hidden-accessible" required="" id="categories" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="null">Filter by Category</option>
                              <option value="">Lorum Ipsum</option>
                              <option value="">Lorum Ipsum</option>
                              <option value="">Lorum Ipsum</option>
                              <option value="">Lorum Ipsum</option>

                              <option value="">Lorum Ipsum</option>
                              <option value="">Lorum Ipsum</option>
                        </select>
                    </li>
                    <li>
                        <select class="form-control select2 select2-hidden-accessible" required="" id="doctors" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="null">Filter by doctor</option>
                              <option value=""></option>
                              <option value="">Lorum Ipsum</option>
                              <option value="">Lorum Ipsum</option>

                              <option value="">Lorum Ipsum</option>

                              <option value="">Lorum Ipsum</option>
                        </select>
                    </li>
                    <li class="form-btn">
                      <button id="searchbutton" onclick="search()" style="width: 100%;"  class="btn btn-primary">Find Now</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
  .blur{
    filter: blur(3px);
  }
</style>
<section class="space mine-space">
    <div class="container container-custom">
        <div id="hidecount" class="row mb-3">
            <div class="col-md-12">
                <small>Results: 10002</small>
            </div>
        </div>
        <div class="row">
            <?php 
            for ($i=0; $i < 30 ; $i++) { ?>
                <div class="col-md-4 col-lg-4 col-sm-6 col-12">
                    <div class="docrtors-box1">
                        <img style="height: 200px;" src="{{asset('public/images/305536281.jpg')}}" class="img-fluid" alt="#">
                        <a href="{{url('')}}/{{ 'doctor-profile' }}"><h4>Dr. Ahsin Javaid</h4></a>
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
          <div id="showsearchcases" class="row blur">
          </div>
    </div>
</section>
<script type="text/javascript">
  function search()
  {
    $('#searchbutton').html('Searching....')
    var casename = $('#casename').val();
    var category = $('#categories').val();
    var doctor = $('#doctors').val();
    if(casename == "")
    {
      var casename = 'null'
    }
    $.ajax({
      type:'GET',
      url:"{{ url('search') }}/"+casename+"/"+category+"/"+doctor,
      datatype:'json',
      success: function(res)
      {
          $('#hideallcases').addClass('blur');
          $('#showsearchcases').addClass('blur');
          setTimeout(function(){ 
            $('#hideallcases').hide();
            $('#hidecount').hide();
           }, 1000);
          $('#showsearchcases').removeClass('blur');
          $('#showsearchcases').html(res);
          $('#searchbutton').html('Search Again')
      }
     })
  }
</script>
@endsection