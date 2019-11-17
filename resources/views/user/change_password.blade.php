@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Change Password</li>
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
<h3 class="box-title">Change Password</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form action="{{route('user.updateInfoForAdmin')}}" method="post">
  {!! csrf_field() !!}
<div class="box-body">
<div class="form-group">
    <label for="txtEmail">Email address:</label>
    <input type="email" name = "txtEmail"  class="form-control" id="email" value = "{{ Auth::user()->email }}" readonly="readonly" />
  </div>
  <div class="form-group">
    <label for="txtCurrPass">Current Password:</label>
    <input type="password" class="form-control" name="txtCurrPass" id="txtCurrPass" required="required" />
  </div>
  <div class="form-group">
    <label for="txtNewPassword">New Password:</label>
    <input type="password" class="form-control" name="txtNewPassword" id="txtNewPassword" required="required" />
  </div>
  <div class="form-group">
    <label for="txtConfirmPassword">Confirm Password:</label>
    <input type="password" class="form-control" name="txtConfirmPassword" id="txtConfirmPassword">
  </div>
</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary">Update Password</button>
</div>
</form>
</div><!-- /.box -->
</section>
@endsection