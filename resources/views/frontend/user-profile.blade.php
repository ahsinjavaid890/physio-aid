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
            @include('frontend.patientsidebar')
        </div>
        <div class="col-md-9">
            <div class="card profile-sidebar">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h5>Profile</h5>
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('errorsecurity'))
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session()->get('errorsecurity') }}
                        </div>
                    @endif
                    @if ($errors->any())
                      <div class="alert alert-danger alert-dismissible">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                    <div class="row">


                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link color-black" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Personal Settings
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <form enctype="multipart/form-data" method="POST" action="{{ url('/updateuserprofile') }}">
                                            {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6 col-12">
                                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" placeholder="First Name" name="name">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input type="text" readonly="" value="{{ Auth::user()->username }}" class="form-control" placeholder="Username" name="username">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6 col-12">
                                                    <input readonly="" type="text" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email" name="email">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input type="text" value="{{ Auth::user()->phonenumber }}" class="form-control" placeholder="Phone No" name="phonenumber">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <select name="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option disabled="" >Country</option>
                                                            @foreach($countries as $r)
                                                                <option @if($r->name ==  Auth::user()->country) selected @endif value="{{ $r->name }}">{{ $r->name }}</option>
                                                            @endforeach
                                                        </select> </div> <!-- /.form-group -->
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input type="text" value="{{ Auth::user()->state }}" class="form-control" placeholder="State Name" name="state">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6 col-12">
                                                    <input value="{{ Auth::user()->longitude }}" name="longitude" class="form-control" type="text" id="longitude">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input value="{{ Auth::user()->latitude }}"  name="latitude" class="form-control" type="text" id="latitude">
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="container container-custom">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="mapid"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <textarea class="form-control" placeholder="Reason To Join" rows="4" name="reasontojoin">{{ Auth::user()->reasontojoin }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="lable-control">Update Profile</label><br>
                                                        <input class="form-control" style="height: 80px;" type="file"  name="profileimage">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <button class="btn btn-outline-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link color-black collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Social Settings
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <form method="POST" action="{{ url('/updateusersociallinks') }}">
                                            {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input type="link" value="{{ Auth::user()->facebook }}" class="form-control"  placeholder="Link of Facebook Profile" name="facebook">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input type="link" value="{{ Auth::user()->twitter }}" class="form-control" placeholder="Link of Twitter Profile" name="twitter">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                 <div class="col-12">
                                                    <input type="link" value="{{ Auth::user()->linkdlin }}" class="form-control" placeholder="Link of Linkedin Profile" name="linkdlin">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <button class="btn btn-outline-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link color-black collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Security Settings
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <form method="POST" action="{{ url('/updateusersecurity') }}">
                                        {{ csrf_field() }}
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <input type="password" class="form-control" placeholder="Current Password" name="oldpassword">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="password" class="form-control" placeholder="New Password" name="newpassword">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="password" class="form-control" placeholder="Repeat Password" name="password_confirmed">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-outline-primary">Submit</button>
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
        </div>
    </div>
    </div>
</section>
<script>
  function initMap() {
    const myLatlng = { lat: {{ Auth::user()->latitude }}, lng: {{ Auth::user()->longitude }} };
    const map = new google.maps.Map(document.getElementById("mapid"), {
      zoom: 4,
      center: myLatlng,
    });
    google.maps.event.addListener(map, "click", function(event) {
            // get lat/lon of click
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();

            // show in input box
            document.getElementById("latitude").value = clickLat.toFixed(5);
            document.getElementById("longitude").value = clickLon.toFixed(5);

              var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(clickLat,clickLon),
                    map: map
                 });
        });
    // Create the initial InfoWindow.
    marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
      // Close the current InfoWindow.
      infoWindow.close();
      // Create a new InfoWindow.
      infoWindow = new google.maps.InfoWindow({
        position: mapsMouseEvent.latLng,
      });
      infoWindow.setContent(
        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
      );
      infoWindow.open(map);
    });
  }
</script>
@endsection