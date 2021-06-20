@extends('layouts.admin-app')
@section('title','Sub-Categories')
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
                        <li class="breadcrumb-item active">Sub Categories</li>
                    </ol>
                </div>
                <h4 class="page-title">Sub Category</h4>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th class="w-30">Image / Icon</th>
                                <th>Title</th>
                                <th>Parent</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td class="w-30">
                                    <img src="{{asset('public/images/')}}/{{ $r->image }}" width="30xp" alt="table-user" class="mr-2 img thumbnail" />
                                </td>
                                <td>{{ $r->name }}</td>
                                <td>{{ DB::table('categories')->where('id', $r->parentcategory)->first()->name }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/edit/subcategory')}}/{{ $r->id }}" class="action-icon" title="Edit Category"> <i class="mdi mdi-pencil"></i></a>
                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{url('deletesubcategory')}}/{{ $r->id }}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div> <!-- container -->
@endsection