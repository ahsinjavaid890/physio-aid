@extends('layouts.admin-app')
@section('title','View Message')
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
                        <li class="breadcrumb-item"><a href="{{url('admin/messages')}}">Contact Messages</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
                <h4 class="page-title">View Message</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="card text-center">
                <div class="card-body">

                    <div class="text-left mt-3">
                        <p class="text-muted mb-2 font-13"><strong>First Name :</strong> <span class="ml-2">{{ $data->fname }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Last Name :</strong> <span class="ml-2">{{ $data->lname }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $data->email }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $data->phone }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Dated :</strong><span class="ml-2">
                            {{ $data->created_at }}
                        </span></p>


                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

            <!-- Messages-->

        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <p>
                        {{ $data->message }}
                    </p>
                    
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div>
<!-- container -->
@endsection