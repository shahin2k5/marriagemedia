@extends('admin.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Company Info</li>
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
<h3 class="box-title">Company Inforamtion</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form action="{{route('admin.createCompanyInfo')}}" method="post"  enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="box-body">
 <div class="row">
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="txtName">Company Name:</label>
    <input type="text" name = "txtName"  class="form-control" id="txtName" value="{{$companyInfo->company_name or ''}}" autofocus="autofocus" />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtAddress">Address:</label>
    <textarea class="form-control" name="txtAddress" id="txtAddress">{{$companyInfo->address or ''}}</textarea>
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtPhoneNo">Phone No:</label>
    <input type="number" class="form-control" name="txtPhoneNo" id="txtPhoneNo"  value="{{$companyInfo->phone or ''}}" />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtMobileNo">Mobile No:</label>
    <input type="number" class="form-control" name="txtMobileNo" id="txtMobileNo" value="{{$companyInfo->mobile_no or ''}}">
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtEmailId">Email ID:</label>
    <input type="email" class="form-control" name="txtEmailId" id="txtEmailId" value="{{$companyInfo->email or ''}}">
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="flLogoIcon">Logo / Icon:</label>
    <input type="file" class="form-control" name="flLogoIcon" id="flLogoIcon">
  </div>
  </div>
</div>
</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
</div>
</form>
</div><!-- /.box -->
</section>
@endsection