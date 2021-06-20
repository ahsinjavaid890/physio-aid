@extends('layouts.admin-app')
@section('title','New Case')
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
                        <li class="breadcrumb-item active">New Case</li>
                    </ol>
                </div>
                <h4 class="page-title">New Case</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
         @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('createnewcase') }}" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Title</label>
                            <<input type="text" class="form-control" name="tittle" required placeholder="Case Title" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-3">
                        <label for="validationCustom01">Parent Category</label>
                            <select required="" name="categories" class="form-control select2" data-toggle="select2" id="parentcategory">
                                <option value="" disabled="">Select</option>
                                @foreach($parent as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-3">
                        <label for="validationCustom01">Sub  Category</label>
                            <select required="" name="subcategories" class="form-control select2" data-toggle="select2" id="subcategories">
                                <option value="" disabled="">Select</option>
                                @foreach($subcategory as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Description</label>
                            <textarea  class="form-control" name="casedetails" required placeholder="Case Details" rows="4"></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="validationCustom01">Self Critisism</label>
                            <textarea class="form-control" name="selfcriticism" required placeholder="Self Criticism" rows="4"></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="validationCustom03">Main Image </label>
                            <input type="file" class="form-control" style="height: 43px;" required name="mainimg">
                            <div class="invalid-feedback">
                                Please attach image file.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="validationCustom03">Galary Images </label>
                            <input type="file" multiple="" class="form-control" style="height: 43px;" required name="galaryimages[]">
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