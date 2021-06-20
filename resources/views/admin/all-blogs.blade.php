@extends('layouts.admin-app')
@section('title','Blogs')
@section('content-admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blgos</li>
                    </ol>
                </div>
                <h4 class="page-title">All Blogs</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th class="w-30">Image / Icon</th>
                                <th>Title</th>
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
                                <td>{{ $r->tittle }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td>
                                    <div>
                                        <input type="checkbox" onclick="publish({{$r->id}} ,  {{ $r->status }})" id="switch1" <?php if($r->status == 1){echo 'checked'; } ?> data-switch="success"/>
                                        <label for="switch1" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/edit/blog')}}/{{ $r->id }}" class="action-icon" title="Edit Category"> 
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{ url('deleteblog') }}/{{ $r->id }}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
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
      url: "{{ url('changetopublish') }}/"+one+'/'+two,
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