@extends('layouts.admin-app')
@section('title','Cases')
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
                        <li class="breadcrumb-item active">Cases</li>
                    </ol>
                </div>
                <h4 class="page-title">All Cases</h4>
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
                                <th class="w-30">Image / Icon</th>
                                <th>Title</th>
                                <th>Added By</th>
                                <th>Comments</th>
                                <th>Dated</th>
                                <th>Published</th>
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
                                <td>
                                    <a href="javascript:void(0)">{{ DB::table('users')->where('id', $r->users)->first()->name }}</a>
                                </td>
                                <td>{{ DB::table('casecomments')->where('caseid', $r->id)->count() }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td>
                                    <div>
                                        <input onclick="publish({{$r->id}} ,  {{ $r->published }})" type="checkbox" id="switch{{ $r->id }}" <?php if($r->published == 1){echo 'checked'; } ?> data-switch="success"/>
                                        <label for="switch{{ $r->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/editcase')}}/{{ $r->id }}" class="action-icon" title="Edit Category"> <i class="mdi mdi-pencil"></i></a>
                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{ url('deletecase') }}/{{ $r->id }}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
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
<script type="text/javascript">
  function publish(one,two)
  {
    $.ajax({
      type: "GET",
      url: "{{ url('changetopublishcase') }}/"+one+'/'+two,
      success: function(resp) {
         if(resp == 'error'){
          location.reload();
         }else{
          location.reload();
         } 
      }
    });
  }
</script>
@endsection