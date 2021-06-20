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
<section class="about-section mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="sub-title_center">
                <h2>Members Network</h2>
            </div>
        </div>
    </div>
</section>
<section class="about-section">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <div id="mapid"></div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    @media (min-width: 992px){
.booking-form li {
    width: 38%;
}
}
.redborder{
    border-color: red; 
    color: red;
}
.blur{
    filter: blur(3px);
  }
</style>
<section class="about-section mt-100">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <ul class="booking-form">
                    <li><input type="text" id="doctor" class="form-control" placeholder="Search Doctor" /></li>
                    <li>
                        <div class="form-group">
                            <select class="form-control select2 select2-hidden-accessible" required="" id="countryname" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="null">Country</option>
                                <?php foreach(DB::table('countries')->get() as $r){ ?>
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
<!--                     <li>
                        <select class="form-control select2 select2-hidden-accessible" name="interest" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="" disabled="">Primary Area of Interest</option>
                            <option>Upper limb</option>
                            <option>Shoulder</option>
                            <option>Elbow</option>
                            <option>Wrist</option>
                            <option>Hand</option>
                            <option>Lower limb</option>
                            <option>Hip</option>
                            <option>Knee</option>
                            <option>Foot and Ankle</option>
                            <option>Spine</option>
                            <option>Pelvis</option>
                            <option>Joint Replacement - Hip</option>
                            <option>oint Replacement - Knee</option>
                        </select>
                    </li> -->
                    <li class="form-btn">
                        <button id="searchbutton" onclick="searchmembers()" style="width: 100%;"  class="btn btn-primary">Find Now</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="space mt-30">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div id="hideallcases" class="row">
            @foreach($data as $r)
            <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                <div class="docrtors-box1">
                    <img style="height: 200px;" src="{{asset('public/images/')}}/{{ $r->profileimage }}" class="img-fluid" alt="#">
                    <a href="{{url('')}}/{{ $r->username }}"><h4>{{ $r->name }}</h4></a>
                    <p>{{ $r->country }}</p>
                    <div class="bg-shade">
                        <img src="{{asset('public/frontend/images/bg-shade.png')}}" class="img-fluid" alt="#">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="showsearchcases" class="row blur">
        </div>
    </div>
</section>
<script type="text/javascript">
  function searchmembers()
  {
    var countryname = $('#countryname').val();
    var doctor = $('#doctor').val();
    $('#searchbutton').html('Searching....');
    if(doctor == "")
    {
      var doctor = 'null';
    }
    $.ajax({
      type:'GET',
      url:"{{ url('searchmembers') }}/"+doctor+"/"+countryname,
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