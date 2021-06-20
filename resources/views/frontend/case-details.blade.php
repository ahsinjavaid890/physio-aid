@extends('layouts.app')
@section('title')
<title>{{ $case->name }}</title>
<meta name="DC.Title" content="{{ $case->name }}">
<meta name="rating" content="general">
<meta name="description" content="{{ $case->casedetials }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{asset('public/images')}}/{{$case->image}}">
<meta property="og:title" content="{{ $case->name }}">
<meta property="og:description" content="{{ $case->casedetials }}">
<meta property="og:site_name" content="TopAtLaw">
<meta property="og:url" content="{{ url('') }}/{{ $case->url }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<section class="space">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('')}}/{{ $category->url }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('')}}/{{ $subcategories->url }}">{{ $subcategories->name }}</a></li>
                        <li class="breadcrumb-item active_bread" aria-current="page">{{ $case->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8" style="background-color: #272729">
                    <div class="blog-list blog-deatil">
                        <div class="preview col-md-12">
                            <div class="preview-pic tab-content">
                                @foreach ($caseimages as $i)
                                <div class="tab-pane @if ($loop->first) active  @endif" id="slide{{ $loop->iteration }}"><img class="slide-img" onclick="showimage({{ $i->id }})" src="{{ asset('public/images') }}/{{ $i->image }}" /></div>
                                @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($caseimages as $i)
                                <li style="margin-bottom: 10px;" class="active"><a data-target="#slide{{ $loop->iteration }}" data-toggle="tab"><img class="img-thumb" src="{{asset('public/images')}}/{{ $i->image }}" /></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-text-wrap border-0 pl-0 pr-0">
                            <div class="blog-comment-top border-0">
                                <p><i class="fa fa-calendar"></i>{{ date('d M Y', strtotime($case->created_at)) }}</p>
                            </div>
                            <h3 class="mb-2">{{ $case->name }}</h3>
                            <p>{{ $case->casedetials }}</p>
                            <div class="blog-text-blok">
                                <h3>Self Criticism</h3>
                                <p>{{ $case->self }}</p>
                            </div>
                            <div class="blog-text-blok">
                                <h3>Hardware Used</h3>
                                <p>{{ $case->hardware }}</p>
                            </div>
                        </div>
                    </div>

                    @if(Auth::check())
                    @php
                        $id = Auth::user()->id;
                    @endphp    
                    @if(DB::table('casecomments')->where('users' , $id)->where('caseid' , $case->id)->count() == 0)
                    <div class="blog-comment-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Leave Your Comment</h3>
                            </div>
                        </div>
                        <form  method="POST" action="{{ url('comment') }}">
                            {{ csrf_field() }}
                            <style type="text/css">
                                /* Rating Star Widgets Style */
                                .rating-stars ul {
                                  list-style-type:none;
                                  padding:0;
                                  
                                  -moz-user-select:none;
                                  -webkit-user-select:none;
                                }
                                .rating-stars ul > li.star {
                                  display:inline-block;
                                  
                                }

                                /* Idle State of the stars */
                                .rating-stars ul > li.star > i.fa {
                                  font-size:1.5em; /* Change the size of the stars */
                                  color:#ccc; /* Color on idle state */
                                }

                                /* Hover state of the stars */
                                .rating-stars ul > li.star.hover > i.fa {
                                  color:#FFCC36;
                                }

                                /* Selected state of the stars */
                                .rating-stars ul > li.star.selected > i.fa {
                                  color:#FF912C;
                                }

                            </style>
                        <div class="row">
                            <div class="col-md-12">
                              <div class='rating-stars'>
                                <ul id='stars'>
                                  <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                  </li>
                                  <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                  </li>
                                  <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                  </li>
                                  <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                  </li>
                                  <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                  </li>
                                </ul>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" value="{{ $case->id }}" name="caseid">
                            <input id="reviews" type="hidden"  name="stars">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea required="" class="form-control" placeholder="Write a Comment.." name="comment" rows="3" spellcheck="false"></textarea>
                                    <button type="submit" class="btn btn-success mt-4">Add Comment</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    @endif
                @endif

                    @if($casecomments->count() > 0)
                    <div class="comment-wrap">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h3>Comment ({{ $casecomments->count() }})</h3>
                            </div>
                        </div>
                        @foreach($casecomments as $r)
                        <div class="media mb-4">
                            <img style="height: 50px;width: 50px;" src="{{asset('public/images/')}}/@php echo DB::table('users')->where('id' , $r->users)->get()->first()->profileimage @endphp" class="mr-3 img-fluid" alt="#">
                            
                            <div class="media-body">
                                <div style="background-color: #3a3b3c;padding: 15px;border-radius: 10px;color: white;margin: 0px 0px 20px 0px;">
                                <h5 class="mt-2">@php echo DB::table('users')->where('id' , $r->users)->get()->first()->name @endphp</h5> <span style="color: #efd038;font-size: 20px;"><?php 
                                          if($r->reviews >= 1 && $r->reviews < 2){ ?>
                                            <i class="fa fa-star"></i>
                                          <?php }elseif ($r->reviews >= 2 && $r->reviews < 3){ ?>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          <?php }elseif ($r->reviews >= 3 && $r->reviews < 4){ ?>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          <?php }elseif ($r->reviews >= 4 && $r->reviews < 5){ ?>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          <?php }elseif ($r->reviews == 5){ ?>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                          <?php } ?></span>
                                <p style="text-align: justify;">{{ $r->comment }}</p>
                            </div>
                                <div id="allreplys{{ $r->id }}">
                                    @foreach(DB::table('casereply')->where('casecommentsid' , $r->id)->get() as $p)
                                        <div style="display: flex;margin-bottom: 10px;">
                                            <div style="width: 8%;">
                                                <img style="height: 40px;width: 40px;" src="{{asset('public/images/')}}/{{ DB::table('users')->where('id' , $p->user)->get()->first()->profileimage }}">
                                            </div>
                                            <div style="width: 92%;" class="right-inner-addon input-container">
                                                <div style="background-color: #3a3b3c;padding: 15px;border-radius: 10px;color: white;margin: 0px 0px 10px 0px;">
                                                    <div style="margin: 0px;" class="row">
                                                            <a href="{{ url('') }}/{{ DB::table('users')->where('id' , $p->user)->get()->first()->username }}">{{ DB::table('users')->where('id' , $p->user)->get()->first()->name }}</a>
                                                    </div>
                                                    <p style="text-align: justify;">{{ $p->reply }}</p>
                                                </div>
                                                  
                                            </div>
                                        </div>
                                      
                                    @endforeach
                                </div>
                                @if(Auth::check())
                                <div style="display: flex;">
                                        <div style="width: 8%;">
                                            <img style="height: 40px;width: 40px;" src="{{asset('public/images/')}}/{{ Auth::user()->profileimage }}">
                                        </div>
                                        <div style="width: 92%;" class="right-inner-addon input-container">
                                              <div class="input-group mb-3">
                                                  <input id="reply{{$r->id}}" type="text" class="form-control wage" placeholder="Write a Reply..">
                                                  <div class="input-group-append">
                                                    <button onclick="submitreply({{$r->id}})" style="background-color: #1d1d1d !important;border: none;color:white;width: 41px;height: 48px;padding-top: 0px;padding-bottom: 0px;margin-top: 1px;" class="fa fa-paper-plane" type="submit"></button>
                                                  </div>
                                                </div>
                                        </div>
                                </div>
                                <script type="text/javascript">
                                    function submitreply(id)
                                    {
                                        var value = $('#reply'+id).val();
                                        $.ajax({
                                          type: "GET",
                                          url: "{{ url('submitreply') }}/"+id+"/"+value,
                                          success: function(resp) {
                                            $('#allreplys'+id).html(resp);
                                            $('#reply'+id).val('');
                                          }
                                        });
                                    }
                                </script>
                                @endif
                                <hr>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
            </div>
            <style type="text/css">
                .docrtors-box1 ul li {
                display: block;
                }
                .modal-header {
                    border-bottom: 1px solid #272729;
                }
            </style>
            <div class="col-md-4">
                <div class="docrtors-box1">
                    <img src="{{ url('public/images/') }}/{{ $user->profileimage }}" class="img-fluid" alt="#">
                    <a href="{{ url('') }}/{{ $user->username }}"><h4>{{ $user->name }}</h4></a>
                    <ul>
                        <li>{{ $user->country }} , {{ $user->state }}</li>
                        <li>{{ $user->primaryareaofintrest }}</li>
                        <li>{{ $user->qualification }}</li>
                    </ul>
                    @if(Auth::check())
                    <ul>
                        @if(Auth::user()->id == $user->id)
                            <li> {{ DB::table('followusers')->where('followed', $user->id)->count() }} Follower </li>
                        @else
                        <li> {{ DB::table('followusers')->where('followed', $user->id)->count() }} Follower </li>
                        @if(DB::table('followusers')->where('followed', $user->id)->where('follower' , Auth::user()->id)->count() == 1)
                         <li id="showunfollow" class="mt-4"> <button onclick="unfollow({{$user->id}})" class="btn btn-outline-primary">Un Follow</button> </li>
                         <li style="display: none;" id="hidefollow" class="mt-4"> <button onclick="follow({{$user->id}})" class="btn btn-outline-primary">Follow</button> </li>
                         @else
                         <li id="showunfollow" style="display: none;" class="mt-4"> <button onclick="unfollow({{$user->id}})" class="btn btn-outline-primary">Un Follow</button> </li>
                        <li id="hidefollow" class="mt-4"> <button onclick="follow({{$user->id}})" class="btn btn-outline-primary">Follow</button> </li>
                        @endif
                        <li  style="color: red;" id="followmessage"></li>
                        @endif
                        </ul>
                    @endif
                    <div class="bg-shade">
                        <img src="{{ asset('public/frontend/images/bg-shade.png') }}" class="img-fluid" alt="#">
                    </div>
                </div>
                @if(!empty($star))
                <div class="blog-sidebar">
                    <div class="blog-sidebar_wrap">
                        <div class="row mb-2">
                            <div class="col-md-12 text-center">
                                Case Reviews
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="case-ratings-big">
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
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="blog-sidebar">
                    <div class="blog-sidebar_wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-sidebar">
                    <div class="blog-sidebar_heading">
                        <h4>Case Visitors</h4>
                    </div>
                    <div class="blog-sidebar_wrap text-center">
                        {{ $sendvisitor }} Visitor
                    </div>
                </div>
                @if(!empty($case->resource1))
                <div class="blog-sidebar">
                    <div class="blog-sidebar_heading">
                        <h4>Refrenced Links</h4>
                    </div>
                    <div class="blog-sidebar_wrap">
                        <ul class="blog-sidebar_category">
                            <li><a target="_blank" href="{{ $case->resource1 }}">{{ $case->resource1 }}</a> </li>
                            <li><a target="_blank" href="{{ $case->resource2 }}">{{ $case->resource2 }}</a> </li>
                            <li><a target="_blank" href="{{ $case->resource3 }}">{{ $case->resource3 }}</a> </li>
                            <li><a target="_blank" href="{{ $case->resource4 }}">{{ $case->resource4 }}</a> </li>
                        </ul>
                    </div>
                </div>
                @endif
                <div class="blog-sidebar">
                    <div class="blog-sidebar_heading">
                        <h4>Categories</h4>
                    </div>
                    <div class="blog-sidebar_wrap">
                        <ul class="blog-sidebar_category">
                            @foreach($allcategories as $r)
                            <li><a href="{{ url('') }}/{{ $r->url }}">{{ $r->name  }}</a> <span>@php echo DB::table('cases')->where('categories' , $r->id)->count() @endphp</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="blog-join_us">
                    <div class="blog-join_us-content">
                        <h6>AD BANNER</h6>
                        <p>Lorem ipsum dolor sit amet conse</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div style="background-color: #272729;" class="modal-header">
        <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div style="background-color: #272729;" class="modal-body">
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

          /* 1. Visualizing things on Hover - See next part for action on click */
          $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
           
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
              if (e < onStar) {
                $(this).addClass('hover');
              }
              else {
                $(this).removeClass('hover');
              }
            });
            
          }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
              $(this).removeClass('hover');
            });
          });
          
          
          /* 2. Action to perform on click */
          $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            
            for (i = 0; i < stars.length; i++) {
              $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
              $(stars[i]).addClass('selected');
            }
            

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $('#reviews').val(ratingValue);
          });
          
          
        });


        function responseMessage(msg) {
          $('.success-box').fadeIn(200);  
          $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
        function showimage(id)
        {


           var loader =  '<div style="text-align:center;"><img src="https://i.gifer.com/ZZ5H.gif" id="imagepreview" ></div>';
            $.ajax({
              type: "GET",
              url: "{{ url('showimage') }}/"+id,
              success: function(resp) {
                $('#myModal').modal('toggle');
                $('.modal-body').html(loader);
                setTimeout(function(){ 
                    $('.modal-body').html(resp);
                }, 1000);
              }
            });
        }
</script>
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