@extends('layouts.admin-app')
@section('title','Edit Case')
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
                    <li class="breadcrumb-item"><a href="{{url('admin/cases')}}">Cases</a></li>
                    <li class="breadcrumb-item active">Edit Case</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Case</h4>
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
    <div class="col-12">
        <p>Visit Post <a href="{{ url('') }}/{{ $case->url }}">here</a></p> 
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                 <form enctype="multipart/form-data" method="POST" action="{{ url('updatecasedetails') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $case->id }}" name="id">
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Title</label>
                        <input type="text" value="{{ $case->name }}" class="form-control" name="tittle" required placeholder="Case Title" >
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Parent Category</label>
                            <select name="categories" class="form-control select2" data-toggle="select2" id="parentcategory">
                            <option value="" disabled="">Select</option>
                            @foreach($parent as $r)
                              <option @if($case->categories == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Sub  Category</label>
                        <select name="subcategories" class="form-control select2" data-toggle="select2" id="subcategories">
                            <option value="" disabled="">Select</option>
                            @foreach($subcategory as $r)
                              <option @if($case->subcategories == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Description</label>
                        <textarea class="form-control" name="casedetails" required placeholder="Case Details" rows="4">{{ $case->casedetials }}</textarea>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="validationCustom01">Self Critisism</label>
                        <textarea class="form-control" name="selfcriticism" required placeholder="Self Criticism" rows="4">{{ $case->self }}</textarea>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Case</button>
                </form>   

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ url('updatecaseimage') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $case->id }}" name="id">
                    <div class="form-group mb-3">
                        <label for="validationCustom03">Main Image </label>
                        <input type="file" class="form-control" style="height: 43px;" required name="image">
                        <div class="invalid-feedback">
                            Please attach image file.
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Main Image</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ url('updatecasegalaryimage') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $case->id }}" name="id">
                    <div class="form-group mb-3">
                        <label for="validationCustom03">Galary Images</label>
                        <input type="file" class="form-control" multiple="" style="height: 43px;" required name="galaryimages[]">
                        <div class="invalid-feedback">
                            Please attach image file.
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Galary Image</button>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- end row -->
</div> <!-- container -->
<script type="text/javascript">
$( "#parentcategory" ).change(function() {
    var value = $('#parentcategory').val();
    $.ajax({
        type: "GET",
        url: "{{ url('getsubcategory') }}/"+value,
        success: function(resp) {
          $('#subcategories').html(resp);
        }
    });
});
</script>
@endsection