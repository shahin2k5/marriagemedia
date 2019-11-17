@extends('agent.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('agent.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Profile</li>
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
<form action="{{route('agent.updateAgentProfile', $agentInfo->client_id)}}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Agent Profile</h3>
<span class="pull-right"> 
<a href="{{route('agent.showAgentProfile')}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">

<div class="col-md-6">
<div class="form-group">
<label>Full Name</label>
<input type="text" name="txtFullName" class="form-control" value="{{$agentInfo->full_name or ''}}" required autofocus  />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Company Name</label>
<input type="text" name="txtCompanyName" class="form-control" value="{{$agentInfo->company_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mobile No</label>
<input type="number" name="txtMobile" class="form-control" value="{{$agentInfo->mobile_no or ''}}" required />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Address</label>
<input type="text" name="txtAddress" class="form-control" value="{{$agentInfo->address or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Icon</label>{{$agentInfo->icon or ''}}
<input type="file" name="flIcon" class="form-control" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Cover Photo</label>{{$agentInfo->cover_photo or ''}}
<input type="file" name="flCoverPhoto" class="form-control" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Username</label>
<input type="text" name="txtUsername" class="form-control" value="{{$agentInfo->UserDetails->username or ''}}" required />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Email</label>
<input type="email" name="txtEmail" class="form-control" value="{{$agentInfo->UserDetails->email or ''}}" required />
</div>
</div>


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm">Save / Update</button>
</div>
</div><!-- /.box -->
</form>
</section>
@endsection
