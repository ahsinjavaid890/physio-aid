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
                        <li class="active">
                            <a href="{{url('user-dashboard')}}">
                                <i class="fa fa-shopping-cart"></i>
                                All Appointments </a>
                        </li>
                        <li >
                            <a href="{{url('')}}">
                                <i class="fa fa-shopping-cart"></i>
                                My Specialist </a>
                        </li>
                        <li >
                            <a href="{{url('messages')}}">
                                <i class="fa fa-shopping-cart"></i>
                                Messages</a>
                        </li>
                        <li >
                            <a href="">
                                <i class="fa fa-shopping-cart"></i>
                                Meating</a>
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
                        <div class="col-md-8">
                            <h5>All Appointments</h5>
                        </div>
<!--                                 <div class="col-md-4 text-right">
                            <div class="search_keyword wow fadeInRight" data-wow-duration="1s" data-wow-delay=".2s"> 
                                <a class="btn btn-primary" href="{{url('add-case')}}">Add New</a>
                            </div>
                        </div> -->
                    </div>
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th>Appointment ID</th>
                                <th>Specialist</th>
                                <th>Status</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                            <tr>
                                <td class="w-60">
                                    <a class="link-style-none" href="">1</a>
                                </td>
                                <td class="w-60">
                                    <a class="link-style-none" href="">Lorum Ipsum</a>
                                </td>
                                <td class="w-60">
                                    <a class="link-style-none" href="">Lorum Ipsum</a>
                                </td>
                                <td class="w-60">
                                    <a class="link-style-none" href="">Lorum Ipsum</a>
                                </td>
                                <td class="w-60">
                                    <a class="link-style-none" href="">Lorum Ipsum</a>
                                </td>
                                <td class="text-center">
                                    <a href="" title="Edit" class="icon-action"><small><i class="fa fa-edit"></i></small></a>
                                    &nbsp;
                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="" title="Delete" class="icon-action"><small><i class="fa fa-trash"></i></small></a>
                                </td>                                        
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection