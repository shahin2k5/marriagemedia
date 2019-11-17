@extends('user.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href = "{{route('user.showAllUsers')}}">All Users</a></li>
<li class="active">Edit / Update Profile</li>
</ol>
<br/>
<div class="row">
<div class="col-md-12">

@if(Session::has('success'))
  <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> {{Session::get('success')}}
  </div>
  @endif

  @if(Session::has('warning'))
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> {{Session::get('warning')}}
  </div>
  @endif

  </div>
  </div>

</section>



<!-- Main content -->
<section class="content">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Update Profile</h3>
<a href="{{route('user.showProfileForEdit', $profileInfo->id)}}" class="btn btn-danger btn-sm pull-right"><i class="fa fa-refresh"></i></a>
<a href="{{route('user.showAllUsers')}}" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i></a>
</div><!-- /.box-header -->

<div class="box-body">

<div class="accordation">
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion-1-">Personal Information  <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion-1-" class="jb-accordion-content collapse" style="height: auto;">

<form  action="{{route('user.createPersonalForAdmin', $profileInfo->id)}}" method="post">
  {!! csrf_field() !!}
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Full Name</label>
<input type="text" name="txtFullName" class="form-control" placeholder="Full Name" value="{{$profileInfo->full_name or ''}}" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Date Of Birth</label>
<input type="date" name="txtDateOfBirth" class="form-control" placeholder="Date Of Birth"  value="{{$profileInfo->date_of_birth or ''}}" />
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Age</label>
<input type="number" name="txtAge" class="form-control" placeholder="Age according to certificate"  value="{{$profileInfo->age or ''}}" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Religion</label>
<select name="optReligion" class="form-control">
@if($profileInfo->religion=="Muslim")
  <option>Muslim</option>
  <option>Christian</option>
  <option>Hindu</option>
  <option>Buddish</option>
@elseif($profileInfo->religion=="Christian")
  <option>Christian</option>
  <option>Muslim</option>
  <option>Hindu</option>
  <option>Buddish</option>
@elseif($profileInfo->religion=="Hindu")
  <option>Hindu</option>
  <option>Muslim</option>
  <option>Christian</option>
  <option>Buddish</option>
@else
  <option>Buddish</option>
  <option>Muslim</option>
  <option>Christian</option>
  <option>Hindu</option>
@endif
</select>
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Sex</label>
<select name="optSex" class="form-control">
@if($profileInfo->sex=="Male")
  <option>Male</option>
  <option>Female</option>
@else
  <option>Female</option>
  <option>Male</option>
@endif
  
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Blood Group</label>
<input type="text" name="txtBloodGroup" class="form-control" placeholder="A+, A-, O+" value="{{$profileInfo->blood_group or ''}}" />
</div>
</div>
</div>

<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion2-">Family Information <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion2-" class="jb-accordion-content collapse ">

<form action="{{route('admin.createFamilyForAdmin', $profileInfo->id)}}" method="post">
  {!! csrf_field() !!}
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Name</label>
<input type="text" name="txtFathersName" class="form-control" placeholder="Fathers Name" value="{{$profileInfo->fathers_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Occupation</label>
<input type="text" name="txtFathersOccupation" class="form-control" placeholder="Fathers Occupation"  value="{{$profileInfo->fathers_occupation or ''}}" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Name</label>
<input type="text" name="txtMothersName" class="form-control" placeholder="Mothers Name" value="{{$profileInfo->mothers_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Occupation</label>
<input type="text" name="txtMothersOccupation" class="form-control" placeholder="Mothers Occupation"  value="{{$profileInfo->mothers_occupation or ''}}" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Siblings</label>
<input type="text" name="txtSiblings" class="form-control" placeholder="3 brothers and 2 sisters" value="{{$profileInfo->siblings or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Family Values</label>
<select name="optFamilyValues" class="form-control">
@if($profileInfo->family_values=="High Class")
  <option>High Class</option>
  <option>High Middle Class</option>
  <option>Middle Class</option>
@elseif($profileInfo->family_values=="High Middle Class")
  <option>High Middle Class</option>
  <option>Middle Class</option>
  <option>High Class</option>
@else
  <option>Middle Class</option>
  <option>High Class</option>
  <option>High Middle Class</option>
@endif
</select>
</div>
</div>

</div>


<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion3">Occupation <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion3" class="jb-accordion-content collapse ">
<form action="{{route('admin.createOccupationForAdmin', $profileInfo->id)}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Occupation</label>
<input type="text" name="txtOccupation" class="form-control form-check-label" placeholder="Software Engineer, Government Service holder" value="{{$profileInfo->occupation or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Annual Income (USD)</label>
<input type="number" name="txtIncome" class="form-control form-check-label" placeholder="3500" value="{{$profileInfo->annual_income or ''}}" />
</div>
</div>

</div>

<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>

<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion4">About <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion4" class="jb-accordion-content collapse ">

<form action="{{route('admin.createAboutForAdmin', $profileInfo->id)}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Height</label>
<input type="text" name="txtHeight" class="form-control" placeholder="5 feet 10 inch" value="{{$profileInfo->height or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Weight</label>
<input type="text" name="txtWeight" class="form-control" placeholder="78 kg" value="{{$profileInfo->weight or ''}}"/>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Body Type</label>
<select name="optBodyType" class="form-control ">
@if($profileInfo->body_type=="Normal")
  <option>Normal</option>
  <option>Slim</option>
  <option>Athletic</option>
  <option>Average</option>
  <option>Fat</option>
@elseif($profileInfo->body_type=="Slim")
  <option>Slim</option>
  <option>Normal</option>
  <option>Athletic</option>
  <option>Average</option>
  <option>Fat</option>
@elseif($profileInfo->body_type=="Athletic")
  <option>Athletic</option>
  <option>Normal</option>
  <option>Slim</option>
  <option>Average</option>
  <option>Fat</option>
@elseif($profileInfo->body_type=="Average")
  <option>Average</option>
  <option>Normal</option>
  <option>Slim</option>
  <option>Athletic</option>
  <option>Fat</option>
@else
  <option>Fat</option>
  <option>Normal</option>
  <option>Slim</option>
  <option>Athletic</option>
  <option>Average</option>
@endif
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Marital Status</label>
<select name="optMaritalStatus" class="form-control ">
@if($profileInfo->marital_status=="Unmarried")
  <option>Unmarried</option>
  <option>Married</option>
  <option>Divorced</option>
  <option>Widow</option>
  <option>Separated</option>
@elseif($profileInfo->marital_status=="Married")
  <option>Married</option>
  <option>Unmarried</option>
  <option>Divorced</option>
  <option>Widow</option>
  <option>Separated</option>
@elseif($profileInfo->marital_status=="Divorced")
  <option>Divorced</option>
  <option>Unmarried</option>
  <option>Married</option>
  <option>Widow</option>
  <option>Separated</option>
@elseif($profileInfo->marital_status=="Widow")
  <option>Widow</option>
  <option>Unmarried</option>
  <option>Married</option>
  <option>Divorced</option>
  <option>Separated</option>
@else
  <option>Separated</option>
  <option>Unmarried</option>
  <option>Married</option>
  <option>Divorced</option>
  <option>Widow</option>
@endif
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Drink</label>
<select name="optDrink" class="form-control ">
@if($profileInfo->drink=="Yes")
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
@elseif($profileInfo->drink=="No")
  <option>No</option>
  <option>Yes</option>
  <option>Occationaly</option>
  <option>Never</option>
@elseif($profileInfo->drink=="Occationaly")
  <option>Occationaly</option>
  <option>Yes</option>
  <option>No</option>
  <option>Never</option>
@else
  <option>Never</option>
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
@endif
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Smoke</label>
<select name="optSmoke" class="form-control ">
@if($profileInfo->smoke=="Yes")
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
@elseif($profileInfo->smoke=="No")
  <option>No</option>
  <option>Yes</option>
  <option>Occationaly</option>
  <option>Never</option>
@elseif($profileInfo->smoke=="Occationaly")
  <option>Occationaly</option>
  <option>Yes</option>
  <option>No</option>
  <option>Never</option>
@else
  <option>Never</option>
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
@endif
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Diet</label>
<select name="optDiet" class="form-control ">
@if($profileInfo->diet)
  <option>Non-Vegetarian</option>
  <option>Vegetarian</option>
@else
  <option>Vegetarian</option>
  <option>Non-Vegetarian</option>
@endif
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Complexion</label>
<select name="optComplexion" class="form-control ">
@if($profileInfo->complexion=="Fair")
  <option>Fair</option>
  <option>Very Fair</option>
  <option>Black</option>
@elseif($profileInfo->complexion=="Very Fair")
  <option>Very Fair</option>
  <option>Fair</option>
  <option>Black</option>
@else
  <option>Black</option>
  <option>Fair</option>
  <option>Very Fair</option>
@endif
</select>
</div>
</div>

</div>

<div class="row">
  
  <div class="col-md-6">
   <div class="form-group">
    <label>Beard</label>
      <select name="optBeard" class="form-control ">
        <option value="{{$profileInfo->beard or ''}}">{{$profileInfo->beard or 'SELECT'}}</option>
        <option>Yes</option>
        <option>No</option>
      </select>
   </div>
  </div>

  <div class="col-md-6">
   <div class="form-group">
    <label>Mustache</label>
      <select name="optMustache" class="form-control ">
        <option value="{{$profileInfo->mustache or ''}}">{{$profileInfo->mustache or 'SELECT'}}</option>
        <option>Yes</option>
        <option>No</option>
      </select>
   </div>
  </div>
  
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother Tongue</label>
<select name="optMotherTongue" class="form-control ">
@if($profileInfo->mother_tongue=="Bangla")
  <option>Bangla</option>
  <option>English</option>
  <option>Hindi</option>
  <option>Urdu</option>
@elseif($profileInfo->mother_tongue=="English")
  <option>English</option>
  <option>Bangla</option>
  <option>Hindi</option>
  <option>Urdu</option>
@elseif($profileInfo->mother_tongue=="Hindi")
  <option>Hindi</option>
  <option>Bangla</option>
  <option>English</option>
  <option>Urdu</option>
@else
  <option>Urdu</option>
  <option>Bangla</option>
  <option>English</option>
  <option>Hindi</option>
@endif
</select>
</div>
</div>

<div class="col-md-6">
   <div class="form-group">
    <label>Appearance</label>
      <select name="optAppearance" class="form-control ">
        <option value="{{$profileInfo->appearance or ''}}">{{$profileInfo->appearance or 'SELECT'}}</option>
        <option>Panjabi</option>
        <option>Panjabi Tupi</option>
        <option>Shirt Pant</option>
        <option>Jubba</option>
        <option>Selowar Kamiz</option>
        <option>Borkha</option>
      </select>
   </div>
  </div>

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Created By</label>
<select name="optCreatedBy" class="form-control">
@if($profileInfo->added_by=="Self")
  <option>Self</option>
  <option>Guardian</option>
  <option>Relative</option>
  <option>Other</option>
@elseif($profileInfo->added_by=="Guardian")
  <option>Guardian</option>
  <option>Self</option>
  <option>Relative</option>
  <option>Other</option>
@elseif($profileInfo->added_by=="Relative")
  <option>Relative</option>
  <option>Self</option>
  <option>Guardian</option>
  <option>Other</option>
@elseif($profileInfo->added_by=="Other")
  <option>Other</option>
  <option>Self</option>
  <option>Guardian</option>
  <option>Relative</option>
@else
  <option>Other</option>
  <option>Self</option>
  <option>Guardian</option>
  <option>Relative</option>
@endif
</select>
</div>
</div>

</div>



<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>

</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>

<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion5">Finish <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion5" class="jb-accordion-content collapse ">

<form action="{{route('admin.createEducationForAdmin', $profileInfo->id)}}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Photo</label>
    {{$profileInfo->photo or ''}}  
    <input type="file" name="flPhoto" class="form-control">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Education</label>
    <input type="text" name="txtEducation" class="form-control" value="{{$profileInfo->education or ''}}" >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <label>Profile Status</label>
    <select class="form-control" name="optStatus">
@if($profileInfo->profile_status=="Public")
      <option>Public</option>
      <option>Private</option>
      <option>Protected</option>
@elseif($profileInfo->profile_status=="Private")
      <option>Private</option>
      <option>Public</option>
      <option>Protected</option>
@elseif($profileInfo->profile_status=="Protected")
      <option>Protected</option>
      <option>Public</option>
      <option>Private</option>
@else
      <option>Public</option>
      <option>Private</option>
      <option>Protected</option>
@endif
    </select>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Mobile No</label>
      <input type="number" name="txtMobileNo" class="form-control" value="{{$profileInfo->mobile_no or ''}}" />
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Present Address</label>
      <textarea name="txtAddress" class="form-control" >{{$profileInfo->address or ''}}</textarea>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Permanent Address</label>
      <textarea name="txtPermanentAddress" class="form-control" >{{$profileInfo->permanent_address or ''}}</textarea>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>City</label>
      <input type="text" name="txtCity" class="form-control form-check-label" placeholder="Dhaka, Chottogram" value="{{$profileInfo->city or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <label>Country Name</label>
    <select class="form-control" name="optCountryName">
      <option>{{$profileInfo->country or 'SELECT COUNTRY'}}</option>
      @foreach($countryList as $cl)
      <option>{{$cl->name}}</option>
      @endforeach
    </select>
  </div>

</div>

<div class="form-group">
      <button type="submit" class="btn btn-warning pull-right">Save & Finish</button>
    </div>
</form>

<br/>
</div>
<p><!-- /.collapse --></p>
</div>
</div>

</div><!-- /.box-body -->

<div class="box-footer" style="text-align: center;color:orange;">
Please complete your profile in order to display in this matrimony website.
</div>
</div><!-- /.box -->
</section>
@endsection
