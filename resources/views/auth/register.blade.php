@extends('layouts.app')
@section('title')
<title>Register</title>
<meta name="DC.Title" content="Register">
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
<style type="text/css">
    .them-button{
            border: none;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            background: none;
            cursor: pointer;
            padding: 25px 80px;
            display: inline-block;
            margin: 15px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            outline: none;
            position: relative;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
            color: #fff;
            background: #226fbe;
            -webkit-transition: none;
            -moz-transition: none;
            transition: none;
            border: 2px dashed #226fbe;
            border-radius: 15px;
    }
</style>
@error('username')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('doctorname')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('doctoremail')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('country')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('primaryareaofintrest')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('qualification')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
@error('doctorpassword')
<script type="text/javascript">
    $(document).ready(function(){
        specialist();
    });
</script>
@enderror
<section class="mb-5 mb-special mt-50">
    <div class="container container-custom">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-lg-8">
                <div class="get-in-touch">
                    <div class="row">
                       <div class="col-md-8">
                           <h3 id="registername">Register</h3>
                       </div> 
                       <div style="text-align: right; display: none;" id="showarrow" class="col-md-4">
                           <i style="font-size: 30px;cursor: pointer;" onclick="back()" class="fa fa-arrow-left" aria-hidden="true"></i>
                       </div>
                    </div>
                    


                    <div id="hideoptions" class="row">
                        <div style="text-align: center;" class="col-md-6">
                            
                            <div style="padding: 10px;">
                                <span onclick="patient()" class="them-button">Patient</span>
                            </div>
                        </div>
                        <div style="text-align: center;" class="col-md-6">
                            <div style="padding: 10px;">
                                <span onclick="specialist()" class="them-button">Specialist</span>
                            </div>
                            
                        </div>
                    </div>


                    <form style="display: none;" class="doctorregistrationform"  method="POST" action="{{ url('registerdoctor') }}">
                         @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('doctorname') }}" type="text" class="form-control" name="doctorname" placeholder="Name" >
                                        <i class="far fa-user"></i>
                                    </div>
                                    @error('doctorname')
                                        <div style="color: red">Name Is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input onkeyup="if (/[^|a-z0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|a-z0-9]+/g,'')" type="text" value="{{ old('username') }}"  class="form-control" id="username" name="username" placeholder="Username" >
                                        <i class="far fa-user"></i>
                                    </div>
                                    @error('username')
                                    <div style="color: red">Username is Required</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('doctoremail') }}" type="email" class="form-control" name="doctoremail" placeholder="Your Email" >
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    @error('doctoremail')
                                    <div style="color: red">Email Is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('doctorphonenumber') }}" type="number" class="form-control" name="doctorphonenumber" placeholder="Your Phone Number">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    @error('doctorphonenumber')
                                    <div style="color: red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                            </div>
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select value="{{ old('country') }}" class="form-control select2 select2-hidden-accessible" name="country" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option disabled="" selected="selected">Country</option>
                                            <?php foreach(DB::table('countries')->get() as $r){ ?>
                                                <option value="{{ $r->name }}">{{ $r->name }}</option>
                                            <?php } ?>
                                        </select>
                                        <i class="far fa-flag"></i>
                                    </div>
                                    @error('doctorpassword')
                                        <div style="color: red">Country is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" value="{{ old('state') }}" class="form-control" placeholder="Your State (optional)" name="state">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" value="{{ old('practiceaddress') }}" class="form-control" placeholder="Practice Address (optional)" name="practiceaddress">
                                        <i class="fa fa-map-markerf"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select value="{{ old('primaryareaofintrest') }}" class="form-control select2 select2-hidden-accessible" name="primaryareaofintrest" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option selected="" disabled="">Primary Area of Interest</option>
                                            <option>Upper limb</option>
                                            <option>Shoulder</option>
                                            <option>Elbow</option>
                                            <option>Wrist</option>
                                            <option>Hand</option>
                                            <option>Lower limb</option>
                                            <option>Hip</option>
                                            <option>Knee</option>
                                            <option>Foot and Ankle</option>
                                            <option>Spine</option>
                                            <option>Pelvis</option>
                                            <option>Joint Replacement - Hip</option>
                                            <option>oint Replacement - Knee</option>
                                        </select>
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    @error('doctorpassword')
                                        <div style="color: red">Interest is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control select2 select2-hidden-accessible" name="qualification" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option selected="" disabled="">Qualification</option>
                                            <option>Specialist Consultant</option>
                                            <option>Advanced Trainee</option>
                                            <option>Junior Trainee</option>
                                            <option>Student</option>
                                            <option>Academic</option>
                                            <option>Other Speciality</option>
                                        </select>
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    @error('doctorpassword')
                                        <div style="color: red">Qualification is Required</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="doctorpassword" placeholder="Enter Password">
                                    <i class="fas fa-lock"></i>
                                </div>
                                @error('doctorpassword')
                                <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" >
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
                            </div>
                        </div>
                    </form>
                    <form style="display: none;" class="patientregistrationform" id="regForm" method="POST" action="{{ route('register') }}">
                         @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" >
                                        <i class="far fa-user"></i>
                                    </div>
                                    @error('name')
                                    <div style="color: red">Name is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input onkeyup="if (/[^|a-z0-9]+/g.test(this.value)) this.value = this.value.replace(/[^|a-z0-9]+/g,'')" type="text" value="{{ old('username') }}"  class="form-control" id="username" name="username" placeholder="Username" >
                                        <i class="far fa-user"></i>
                                    </div>
                                    @error('username')
                                    <div style="color: red">Username is Required</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="Your Email" >
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    @error('email')
                                    <div style="color: red">Email is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input value="{{ old('phonenumber') }}" type="date" class="form-control" name="phonenumber" placeholder="Your Phone Number">
                                    </div>
                                    @error('phonenumber')
                                    <div style="color: red">DOB is Required</div>
                                    @enderror
                                </div>
                                <br>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    @error('password')
                                    <div style="color: red">Password is Required</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" >
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function patient()
    {
        $('#showarrow').show();
        $('#hideoptions').hide();
        $('.doctorregistrationform').hide();
        $('.patientregistrationform').show();
        $('#registername').html('Patient Register')
    }
    function back()
    {
        $('#hideoptions').show();
        $('#registername').html('Register');
        $('.doctorregistrationform').hide();
        $('.patientregistrationform').hide();
        $('#showarrow').hide();
    }
    function specialist()
    {
        $('#showarrow').show();
        $('#hideoptions').hide();
        $('.doctorregistrationform').show();
        $('.patientregistrationform').hide();
        $('#registername').html('Specialist Register')
    }
</script>
@endsection
