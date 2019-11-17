@extends('admin.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Links</li>
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
<form action="{{route('admin.insertNewLinks')}}" method="post" enctype="multipart/form-data">
	{!! csrf_field() !!}

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Links</h3>
<span class="pull-right">	
<a href="{{route('admin.showNewLinks')}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">

<div class="form-group">
<label>Image Icon</label>
<input type="file" name="flImageIcon" class="form-control" />
</div>

<div class="form-group">
<label>Design Icon</label>
<input type="text" name="txtDesignIcon" class="form-control" placeholder="fa fa-facebook, fa fa-twitter" />
</div>

<div class="form-group">
<label>Title</label>
<input type="text" name="txtTitle" class="form-control" placeholder="Facebook, Twitter" />
</div>

<div class="form-group">
<label>Url</label>
<input type="text" name="txtUrl" class="form-control" required />
</div>


</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm">Save</button>
</div>
</div><!-- /.box -->
</form>
</section>
@endsection
