@extends('layouts.admin-app')
@section('title','Profile')
@section('content-admin')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
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
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{asset('public/images/')}}/{{ Auth::user()->profileimage }}" class="rounded-circle avatar-lg img-thumbnail"
                    alt="profile-image">

                    <h4 class="mb-0 mt-2">{{ Auth::user()->name }}</h4>
                    <p class="text-muted font-14">Founder</p>

                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About Me :</h4>
                        <p class="text-muted font-13 mb-3">
                            {{ Auth::user()->bio }}
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ Auth::user()->name }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ Auth::user()->phonenumber }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ Auth::user()->email }}</span></p>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

            <!-- Messages-->

        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('/updateuserprofile') }}">
                        {{ csrf_field() }}
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" placeholder="First Name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Username</label>
                                    <input type="text" readonly="" value="{{ Auth::user()->username }}" class="form-control" placeholder="Username" name="username">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Email</label>
                                    <input readonly="" type="text" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Contact Number</label>
                                    <input type="text" value="{{ Auth::user()->phonenumber }}" class="form-control" placeholder="Phone No" name="phonenumber">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Email</label>
                                    <select name="country" class="form-control select2" data-toggle="select2" id="validationCustom02">
                                        <option value="" disabled="">Select</option>
                                        @foreach($countries as $r)
                                        <option @if($r->name ==  Auth::user()->country) selected @endif value="{{ $r->name }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">State</label>
                                    <input type="text" value="{{ Auth::user()->state }}" class="form-control" placeholder="State Name" name="state">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Longitude</label>
                                    <input type="text" value="{{ Auth::user()->longitude }}" class="form-control" placeholder="Longitude" name="longitude">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Latitude</label>
                                    <input type="text" value="{{ Auth::user()->latitude }}" class="form-control" placeholder="Latitude" name="latitude">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="userbio">Reason To join</label>
                                    <textarea class="form-control" placeholder="Reason To Join" rows="4" name="reasontojoin">{{ Auth::user()->reasontojoin }}</textarea>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="userbio">Update Profile</label>
                                    <input type="file" class="form-control" style="height: 43px;" name="profileimage">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->                                                             
                        <div class="text-right">
                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                        </div>
                    </form>
                    
                </div> <!-- end card body -->
            </div> <!-- end card -->
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('/updateusersecurity') }}">
                        {{ csrf_field() }}
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Security Settings</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Old Password</label>
                                    <input type="password" class="form-control" name="oldpassword" placeholder="Enter Old Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">New Password</label>
                                    <input type="password" class="form-control" name="newpassword" placeholder="Enter New Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Conferm Password</label>
                                    <input type="password" class="form-control" name="password_confirmed" placeholder="Enter Old Password">
                                </div>
                            </div>
                             <!-- end col -->
                        </div> <!-- end row -->                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                        </div>
                    </form>
                    
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
</div>
<!-- container -->
@endsection