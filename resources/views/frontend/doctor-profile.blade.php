@extends('layouts.app')
@section('title')
<title>Dr Ahsin Javaid</title>
@endsection
@section('content')
<section class="space">
    <div class="container container-custom">
        <div class="card case-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('public/images/305536281.jpg') }}" alt="" class="w-100 h-100 case-image img-fluid" />
                            </div>
                            <div class="col-md-6 px-3">
                                <div class="card-block mobile-top px-3">
                                    <h4 class="card-title"><a href="javascript:void(0)">Dr Ahsin Javaid</a></h4>
                                    <ul class="s-none">
                                        <li>- Punjab Pakistan</li>
                                        <li>- Physical Therapist</li>
                                        <li>- Member Since June 2021</li>
                                        <li id="hidefollow" class="mt-4"><button  class="btn btn-outline-primary">Get Appointment</button> </li>
                                    </ul>
                                    <div style="margin: 0px;" class="foot-link-box footlink-box_btn">
                                      <ul>
                                          @if(!empty($data->facebook))
                                          <li><a href="{{ $data->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                          @endif
                                          @if(!empty($data->twitter))
                                          <li><a href="{{ $data->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                          @endif
                                          @if(!empty($data->linkdlin))
                                          <li><a href="{{ $data->linkdlin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                          @endif
                                      </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div id="mapid-2"></div>
                    </div>
                </div>
                <div style="margin-top: 20px;" class="row mb-3">
                    <div class="col-md-12">
                        <h3>Biography</h3>
                    </div>
                </div>
                <div  class="row mb-3">
                    <div style="text-align: justify;" class="col-md-12">
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(!empty($cases))
<section class="mb-5 mt-0">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 ">
                    <h4>Cases of {{ $data->name }}</h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                  @foreach($cases as $r)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card case-card">
                          <div class="row ">
                            <div class="col-md-4">
                                <img src="{{ asset('public/images') }}/{{ $r->image }}" class="w-100 h-100 case-image">
                              </div>
                              <div class="col-md-8 px-3">
                                <div class="card-block px-3 mbb-10">
                                    <span class="case-date">{{ date('M d Y', strtotime($r->created_at)) }} </span>
                                  <h4 class="card-title"><a href="{{url('')}}/{{ $r->url }}">{{ Str::limit($r->name, 40) }}</a></h4>
                                  <ul class="s-none">
                                    <li>@php echo DB::table('users')->where('id' , $r->users)->get()->first()->country @endphp, @php echo DB::table('users')->where('id' , $r->users)->get()->first()->state @endphp</li>
                                    <li>@php echo DB::table('categories')->where('id' , $r->categories)->get()->first()->name @endphp</li>
                                    <li>
                                        <div class="case-ratings">
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
            </div>
        </div>

    </div>
</section>
@endif
<script type="text/javascript">
    function follow(id)
    {
        $.ajax({
          type:'GET',
          url:"{{ url('followmember') }}/"+id,
          datatype:'json',
          success: function(res)
          {
            if(res == 'success')
            {
                $('#hidefollow').hide();
                $('#showunfollow').show();
            }else
            {
                $('#followmessage').html(res);
            }
          }
         })
    }
    function unfollow(id)
    {
        $.ajax({
          type:'GET',
          url:"{{ url('unfollowmember') }}/"+id,
          datatype:'json',
          success: function(res)
          {
            if(res == 'success')
            {
                $('#showunfollow').hide();
                $('#hidefollow').show();
            }else
            {
                $('#followmessage').html(res);
            }
          }
         })
    }
</script>
@endsection

