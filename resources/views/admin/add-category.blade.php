@extends('layouts.admin-app')
@section('title','New Category')
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
                        <li class="breadcrumb-item"><a href="{{url('categories')}}">Categories</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Category</h4>
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
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Category</h4><br>
                    <form enctype="multipart/form-data" method="POST" action="{{ url('createcategory') }}" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Title</label>
                            <input type="text" class="form-control" name="name" id="validationCustom01"
                                placeholder="Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="validationCustom03">Icon / Image</label>
                            <input type="file" class="form-control" name="icon" id="validationCustom09"
                                 required>
                            <div class="invalid-feedback">
                                Please attach image file.
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit Now</button>
                    </form>   

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection