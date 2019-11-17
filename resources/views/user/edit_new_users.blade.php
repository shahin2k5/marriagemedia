@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Edit Users</li>
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
<h3 class="box-title">Edit User Information</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form action="{{route('user.updateUsersList', $userList->id)}}" method="post"  enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="box-body">
 <div class="row">
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="txtName">Name:</label>
    <input type="text" name = "txtName"  class="form-control" id="txtName" value="{{$userList->name or ''}}" autofocus="autofocus" required />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtUsername">Username:</label>
    <input type="text" class="form-control" name="txtUsername" id="txtUsername" value="{{$userList->username or ''}}" required />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtEmail">Email:</label>
    <input type="email" class="form-control" name="txtEmail" value="{{$userList->email or ''}}" id="txtEmail" required />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="flPhoto">Photo:</label><img src="{{asset('image/'.$userList->image)}}" width="10%">
    <input type="file" class="form-control" name="flPhoto" id="flPhoto" />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtAbout">About:</label>
    <textarea class="form-control" name="txtAbout" id="txtAbout">{{$userList->about or ''}}</textarea>
  </div>
  </div>

</div>
</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm pull-right">Update User</button>
</div>
</form>
</div><!-- /.box -->
</section>
@endsection