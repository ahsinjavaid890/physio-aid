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
<section class="mb-5 mb-special">
    <div class="container container-custom">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <img src="{{ url('public/images') }}/{{ Auth::user()->profileimage }}" class="img-circle" width="100px">
                
                        <div class="profile-usertitle-name">
                        {{ Auth::user()->name }}
                        </div>
                        <div class="profile-usertitle-job">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    
                    <div class="profile-usermenu">
                        <ul>
                            <li>
                                <a href="{{url('add-case')}}">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add New Case </a>
                            </li>
                            <li>
                                <a href="{{url('user-dashboard')}}">
                                    <i class="fa fa-shopping-cart"></i>
                                    My Cases </a>
                            </li>
                            <li>
                                <a href="{{url('user-profile')}}">
                                    <i class="fa fa-download"></i>
                                    Profile </a>
                            </li>
                            
                            <li>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
                                    <i class="fa fa-edit"></i>
                                    Logout </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
        <div class="col-md-9">
            <div class="card profile-sidebar">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>Edit - {{ $case->name }}</h5>
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form enctype="multipart/form-data" method="POST" action="{{ url('updatecasedetails') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $case->id }}" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" value="{{ $case->name }}" class="form-control" name="tittle" required placeholder="Case Title" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <select id="parentcategory" name="categories" class="form-control select2 select2-hidden-accessible"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option value="" disabled="">Choose Category</option>
                                            @foreach($parent as $r)
                                              <option @if($case->categories == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="subcategories" name="subcategories" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option value="" >Sub Category</option>
                                          @foreach($subcategory as $r)
                                              <option @if($case->subcategories == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="casedetails" required placeholder="Case Details" rows="4">{{ $case->casedetials }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="selfcriticism" required placeholder="Self Criticism" rows="4">{{ $case->self }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="hardware"  placeholder="Hardware Userd" rows="3">{{ $case->hardware }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h5>Resources</h5>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $case->resource1 }}" name="resource1"  placeholder="http://www.example.com" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $case->resource2 }}" name="resource2"  placeholder="http://www.example.com" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $case->resource3 }}" name="resource3"  placeholder="http://www.example.com" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $case->resource4 }}" name="resource4"  placeholder="http://www.example.com" >
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Update Case</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('updatecaseimage') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $case->id }}" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <p>Main Image</p>
                                                <input type="file" class="form-control" style="height: 80px;" required name="image">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">Update Case Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('updatecasegalaryimage') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <p>Galary Image</p>
                                                <input type="file" multiple="" class="form-control" style="height: 80px;" required name="galaryimages[]">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">Update Case Galary Images</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
$( "#parentcategory" ).change(function() {
    var value = $('#parentcategory').val();
    $.ajax({
        type: "GET",
        url: "{{ url('getsubcategory') }}/"+value,
        success: function(resp) {
          $('#subcategories').html(resp);
        }
    });
});
</script>
@endsection