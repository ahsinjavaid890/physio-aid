@extends('layouts.admin-app')
@section('title','Dashboard')
@section('content-admin')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-users-alt float-right'></i>
                    <h6 class="text-uppercase mt-0">Active Users</h6>
                    <h2 class="my-2">500</h2>
                </div> <!-- end card-body-->
            </div>
            <!--end card-->
            <!--end card-->
        </div> <!-- end col -->
        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-window-restore float-right'></i>
                    <h6 class="text-uppercase mt-0">Doctors</h6>
                    <h2 class="my-2">200</h2>
                </div> <!-- end card-body-->
            </div>
        </div>
        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-briefcase float-right'></i>
                    <h6 class="text-uppercase mt-0">Total Patients</h6>
                    <h2 class="my-2">300</h2>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
</div>
@endsection