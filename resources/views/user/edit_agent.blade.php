@extends('user.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Edit Agent</li>
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
<form action="{{route('user.updateAgent', $agentList->id)}}" method="post" enctype="multipart/form-data">
	{!! csrf_field() !!}

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Edit Agent</h3>
<span class="pull-right">	
<a href="{{route('user.editAgent', $agentList->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">

<div class="col-md-6">
<div class="form-group">
<label>Full Name</label>
<input type="text" name="txtFullName" class="form-control" value="{{$agentList->full_name or ''}}" required autofocus  />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Company Name</label>
<input type="text" name="txtCompanyName" class="form-control" value="{{$agentList->company_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mobile No</label>
<input type="number" name="txtMobile" class="form-control" value="{{$agentList->mobile_no or ''}}" required />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Address</label>
<input type="text" name="txtAddress" class="form-control" value="{{$agentList->address or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Icon</label> {{$agentList->icon or ''}}
<input type="file" name="flIcon" class="form-control" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Cover Photo</label> {{$agentList->cover_photo or ''}}
<input type="file" name="flCoverPhoto" class="form-control" />
</div>
</div>


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm">Update Agent</button>
</div>
</div><!-- /.box -->
</form>
</section>
@endsection
