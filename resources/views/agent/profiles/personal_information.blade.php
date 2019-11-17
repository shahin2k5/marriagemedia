@extends('agent.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('agent.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Complete Profile</li>
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

<div class="row">
  <div class="col-md-12">
    <h3 class="box-title">Edit Profile</h3>
  </div>
  <div class="col-md-12">
    @include('agent.profiles.tabs')   
  </div>
</div>

</div><!-- /.box-header -->

<div class="box-body">

<h4 class="text-center">Personal Infomation</h4>

<div class="container" style="width: 100%">

<form  action="{{route('agent.createPersonalForAgent', $profileInfo->id)}}" method="post">
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
  <option>{{$profileInfo->religion or ''}}</option>
  <option>Anglican</option>
  <option>Atheist</option>
  <option>Baptist</option>
  <option>Buddhist/Taoist</option>
  <option>Christian(Catholic)</option>
  <option>Christian(Other)</option>
  <option>Christian(Protestant)</option>
  <option>Evengelical</option>
  <option>Hindu</option>
  <option>Jain</option>
  <option>Jewish</option>
  <option>Methodist</option>
  <option>Mormon/Lds</option>
  <option>Muslim</option>
  <option>Pagan/Earth- Based</option>
  <option>Scientology</option>
  <option>Sikh</option>
  <option>Spiritual But Not Religious</option>
  <option>Not Religious</option>
  <option>Other</option>
</select>
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Gender</label>
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
<select name="txtBloodGroup" class="form-control">
  <option>{{$profileInfo->blood_group}}</option>
  <option>A+</option>
  <option>A-</option>
  <option>B+</option>
  <option>B-</option>
  <option>AB+</option>
  <option>AB-</option>
  <option>O+</option>
  <option>O-</option>
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

</div><!-- /.box-body -->

<div class="box-footer" style="text-align: center;color:orange;">
Please complete your profile in order to display in this matrimony website.
</div>
</div><!-- /.box -->
</section>
@endsection
