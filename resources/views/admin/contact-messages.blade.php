@extends('layouts.admin-app')
@section('title','Contact Messages')
@section('content-admin')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="url('admin/dashboard')">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Messages</li>
                    </ol>
                </div>
                <h4 class="page-title">All Messages</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td>{{ $r->fname }} {{ $r->lname }}</td>
                                <td>{{ $r->email }}</td>
                                <td>{{ $r->phone }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/view/message')}}/{{ $r->id }}" class="action-icon" title="View Detail"> <i class="mdi mdi-eye"></i></a>
                                    <a href="javascript: void(0);" class="action-icon" title="Delte"> <i class="mdi mdi-delete"></i></a>
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