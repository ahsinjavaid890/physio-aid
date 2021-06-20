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
                <span>___ Search ___</span>
                <h2>From Thousands of Cases</h2>
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
<section class="space mine-space">
    <div class="container container-custom">
        <div id="hidecount" class="row mb-3">
            <div class="col-md-12">
                <small>Results: {{ $cases->count() }}</small>
            </div>
        </div>
        <div id="hideallcases" class="row">
              @foreach($cases as $r)
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card case-card">
                      <div class="row ">
                        <div class="col-md-4">
                            <img src="{{ asset('public/images') }}/{{ $r->image }}" class="w-100 h-100 case-image">
                          </div>
                          <div class="col-md-8 px-3">
                            <div class="card-block px-3 mbb-10">
                                <span class="case-date">{{ date('M d Y', strtotime($r->created_at)) }} <a href="{{url('')}}/{{ DB::table('users')->where('id' , $r->users)->get()->first()->username }}" class="theme-color">By @php echo DB::table('users')->where('id' , $r->users)->get()->first()->name @endphp</a></span>
                              <h4 class="card-title"><a href="{{url('')}}/{{ $r->url }}">{{ Str::limit($r->name, 40) }}</a></h4>
                              <ul class="s-none">
                                <li>@php echo DB::table('users')->where('id' , $r->users)->get()->first()->country @endphp, @php echo DB::table('users')->where('id' , $r->users)->get()->first()->state @endphp</li>
                                <li>@php echo DB::table('categories')->where('id' , $r->categories)->get()->first()->name @endphp</li>
                                <li>
                                  @php 

                                      $casecomments = DB::table('casecomments')->where('status' , 1)->where('caseid' ,$r->id)->get();
                                      $totalreviews = $casecomments->count();
                                        if(!empty($totalreviews)){
                                        $reviewssum = $casecomments->sum('reviews');
                                        $star = $reviewssum/$totalreviews;
                                      }else{
                                        $star = 0;
                                      }

                                    @endphp
                                    <div class="case-ratings">
                                      <?php 
                                      if($star >= 1 && $star < 2){ ?>
                                        <i class="fa fa-star"></i>
                                      <?php }elseif ($star >= 2 && $star < 3){ ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      <?php }elseif ($star >= 3 && $star < 4){ ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      <?php }elseif ($star >= 4 && $star < 5){ ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      <?php }elseif ($star == 5){ ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      <?php } ?>
                                    </div>
                                </li>
                              </ul>
                            </div>
                          </div>
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