@extends('admin.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href = "{{route('admin.showAllUsers')}}">All Users</a></li>
<li class="active">New Profile</li>
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
<h3 class="box-title">Add New Profile</h3>
<span class="pull-right">
<a href="{{route('admin.showAllUsers')}}" class="btn btn-warning btn-sm"><i class="fa fa-reply"></i></a>	
<a href="{{route('admin.showNewProfile')}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">


<form  action="{{route('admin.insertNewProfile')}}" method="post">
  {!! csrf_field() !!}
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Full Name</label>
<input type="text" name="txtFullName" class="form-control" placeholder="Full Name" required="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Date Of Birth</label>
<input type="date" name="txtDateOfBirth" class="form-control" placeholder="Date Of Birth" />
</div>
</div>
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Fathers Name</label>
<input type="text" name="txtFathersName" class="form-control" placeholder="Fathers Full Name" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Religion</label>
<select name="optReligion" class="form-control">
  <option>Select</option>
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
  <option>Male</option>
  <option>Female</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Username</label>
<input type="text" name="txtUsername" value="{{$username}}" class="form-control" readonly="readonly" />
</div>
</div>

</div>


<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="txtEmail" class="form-control" required />
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="txtPassword" class="form-control" required />
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Occupation</label>
      <input type="text" name="txtOccupation" class="form-control" />
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Mobile No</label>
      <input type="number" name="txtMobileNo" class="form-control" required />
    </div>
  </div>
</div>

<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>


</div><!-- /.box-body -->

<div class="box-footer" style="text-align: center;color:orange;">
Please complete your profile in order to display in this matrimony website.
</div>
</div><!-- /.box -->
</section>
@endsection
