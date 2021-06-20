@extends('layouts.app')
@section('title')
<title>{{ $parent->name }}</title>
<meta name="DC.Title" content="{{ $parent->name }}">
<meta name="rating" content="general">
<meta name="description" content="Uploading images and case data to the catalogue is quick and uncomplicated. First you'll need to log in, then click above to upload images directly from your smartphone or desktop. Provide some case details (see the syle guide for tips) and you're done.">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ asset('public/frontend/images/logo-mine.png') }}">
<meta property="og:title" content="{{ $parent->name }}">
<meta property="og:description" content="Uploading images and case data to the catalogue is quick and uncomplicated. First you'll need to log in, then click above to upload images directly from your smartphone or desktop. Provide some case details (see the syle guide for tips) and you're done.">
<meta property="og:site_name" content="TopAtLaw">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<section class="space sub-header" style="background: url(../images/sub-header-bg.png) no-repeat #4565cf;">
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub-header_content">
                        <p>Subcategory Index</p>
                        <h3>Welcome to the catalogue {{ $parent->name }}</h3>
                        <h3>Browse subcategories below</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sub-header_main">
                        <h2>Sub Index</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
<br/><br/> 
<!--     <section class="about-section mt-5">
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-12">
                    <ul class="booking-form">
                        <li><input type="text" class="form-control" placeholder="Search by Keyword" /></li>
                        <li>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="" disabled="">Browse by Subcategory</option>
                            @foreach($data as $r)
                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                        </li>
                        <li>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="">Search by Surgeon</option>
                                <option>Doctor Name</option>
                                <option>Doctor Name</option>
                                <option>Doctor Name</option>
                                <option>Doctor Name</option>
                            </select>
                        </li>
                        <li class="form-btn">
                            <a href="#" class="btn btn-primary">Find Now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
<section class="about-section mt-5">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <ul class="booking-form">
                    <li><input type="text" id="casename" class="form-control" placeholder="Search by Keyword" /></li>
                    <li>
                        <select class="form-control select2 select2-hidden-accessible" required="" id="categories" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="null">Filter by Category</option>
                            @foreach($allcategories as $r)
                              <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <select class="form-control select2 select2-hidden-accessible" required="" id="doctors" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="null">Filter by Surgeon</option>
                             @foreach($users as $r)
                              <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
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
<section class="services-2 mb-100">
    <div class="container container-custom">
        <div id="hideallcases" class="row">
            @foreach($data as $r)
            <div class="col-md-2 d-flex flex-fill flex-column">
                <div class="service-box2">
                    <img src="{{asset('public/images/')}}/{{ $r->image }}" class="service-box2-img" alt="{{ $r->name }}">
                    <a href="{{ url('') }}/{{ $r->url }}" class="link-href"><h3>{{ $r->name }}<small class="f-12"> ({{ DB::table('cases')->where('subcategories' , $r->id)->get()->count() }})</small></h3></a>
                </div>
            </div>
            @endforeach
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