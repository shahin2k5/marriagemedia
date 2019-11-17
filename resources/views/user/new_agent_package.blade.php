@extends('user.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Packages</li>
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
<form action="{{route('user.insertAgentPackage')}}" method="post" enctype="multipart/form-data">
	{!! csrf_field() !!}

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Agent Packages</h3>
<span class="pull-right">	
<a href="{{route('user.showNewAgentPackage')}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">

<div class="form-group">
<label>Package Name</label>
<input type="text" name="txtPackageName" class="form-control" autofocus required />
</div>

<div class="form-group">
<label>Validity Days</label>
<input type="number" name="txtValidityDays" class="form-control" required />
</div>

<div class="form-group">
<label>Limit Profiles</label>
<input type="number" name="txtLimitProfiles" class="form-control" required />
</div>

<div class="form-group">
<label>Price</label>
<input type="number" name="txtPrice" class="form-control" step="any" required />
</div>


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm">Save</button>
</div>
</div><!-- /.box -->
</form>
</section>
@endsection
