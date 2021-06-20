<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  @yield('title')
  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/all.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/slick.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/slick-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/magnific-popup.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/purecookie.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet" />
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <script src="{{ asset('public/frontend/js/jquery-3.5.1.min.js') }}" type="text/javascript"></script>
   <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=604bac164d1bac0012adeeb5&product=sop' async='async'></script>

</head>
  <body style="overflow-x: hidden;">

    @include('includes.navbar')

      <!-- Page Contents -->
    @yield('content')

    <!-- Footer -->

    @include('includes.footer')

  </body>

  <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
 
  <script src="{{ asset('public/frontend/js/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/frontend/js/slick.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/frontend/js/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/frontend/js/script.js') }}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3E5rldauX3EwDxpPmNXkPeHNmVV20Vt8&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</html>

<style type="text/css">
  .pad-o {
    padding-bottom: 0px !important;
}
.item-pets {
    border-bottom: 1px solid #ebebeb;
    padding-top: 15px;
}
.thumb-image {
    display: block;
    width: 100%;
    
    position: relative;
}


.leaflet-container a {
    color: #0078A8;
}
.star-ul {
    list-style: none;
    padding: 0px;
    margin: 0px;
}

.leaflet-popup-content
{
  width: 273px;
}

.star-ul li {
    float: left;
    margin-right: 10px;
    color: #fdc600;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({
        closeOnSelect: false
    });
});
</script>
  
<?php 
    $members = url('').'/members-network';
    $currenturl =  url()->current();
?>

@if($currenturl == $members) 
<!-- Member's network -->
<script type="text/javascript">
    var membersnetwork = L.map('mapid').setView([{{ $userlatitide }},{{ $userlongitude }}],6 , 20);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 18
}).addTo(membersnetwork);
var greenIcon = L.icon({
    iconUrl: 'https://devpets.petsportal.ch/public/pet_pointer_yellow.png',
    iconSize:     [30, 60],
    shadowSize:   [25, 32],
    iconAnchor:   [11, 47],
    shadowAnchor: [4, 62],
    popupAnchor:  [-3, -76]
}); 
    @foreach(DB::table('users')->get() as $r)
      var marker = L.marker([{{ $r->longitude }}, {{ $r->latitude }}]).addTo(membersnetwork).bindPopup('<div class="row item-pets"><div class="col-md-5 col-sm-6"><div class="item-loop pad-o"><div class="thumb-image img-cat-imp"><a href="{{ url("") }}/{{ $r->username }}"><img  class="img-responsive lazy error img-cover" data-src="{{ url("public/images") }}/{{ $r->profileimage }}" alt="{{ $r->name }}" src="{{ url("public/images") }}/{{ $r->profileimage }}" data-was-processed="true" /></a></div></div></div><div class="col-lg-7 col-md-6 col-sm-6 col-12"><div class="row"><div class="col-md-12"><div class="item-loop border-none"><div class="item-title f-20 pet-title"><a href="{{ url("") }}/{{ $r->username }}"><i class="fa fa-bolt d-none"></i>{{ $r->name }}</a></div><div class="location p-detail-location">{{ $r->state }}, {{ $r->country }} </div></div></div></div></div></div>');
    @endforeach
</script>

@else

<script>
    var map = L.map('map').fitWorld();

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=token', {
        maxZoom: 18,

        id: 'mapbox.streets'
    }).addTo(map);

    function onLocationFound(e) {
        var radius = e.accuracy / 2;

        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();

        L.circle(e.latlng, radius).addTo(map);
    }

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate({setView: true, maxZoom: 16});

</script>


<script>
var x = document.getElementById("map");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    document.getElementById("frmLat").value = position.coords.latitude;
    document.getElementById("frmLon").value = position.coords.longitude;            
}
</script>
@if(isset(Auth::user()->longitude))
@php 
  $longitude = Auth::user()->longitude;
  $lattitude = Auth::user()->latitude;
@endphp
<script type="text/javascript">
    var mymap = L.map("mapid").setView([{{ $longitude }},{{ $lattitude }}], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 8,
    }).addTo(mymap);
    var marker = L.marker([{{ $longitude }}, {{ $lattitude }}]).addTo(mymap);
</script>
@endif

@endif
@if(isset($data->longitude))
<script type="text/javascript">
    var mymap = L.map("mapid-2").setView([{{ $data->longitude }}, {{ $data->latitude }}], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 8,
    }).addTo(mymap);
    var marker = L.marker([{{ $data->longitude }}, {{ $data->latitude }}]).addTo(mymap);
</script>
@endif

<!-- Signup Page -->
<script type="text/javascript">
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        $('#nextBtn').hide();
        $('#submitbutton').show();
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        $('#nextBtn').show();
        $('#submitbutton').hide();
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    // if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    showTab(currentTab);
}
</script>