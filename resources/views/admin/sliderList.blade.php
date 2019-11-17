@extends('admin.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="{{route('admin.showSliderImage')}}">Slider</a></li>
<li class="active">Slider Images</li>
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
<h3 class="box-title">Slider Images</h3>
<span class="pull-right">
  <a href="{{route('admin.showSliderImage')}}" class="btn btn-warning btn-sm">
    <i class="fa fa-reply fa-fw"></i>
  </a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example2" class="table table-bordered table-hovar table-striped">
  <thead>
  	<tr>
	  	<th width="10%">Serial No</th>
	  	<th width="40%">Image</th>
	  	<th width="30%">Text</th>
	  	<th width="20%">Action</th>
  	</tr>
  </thead>
  <tbody>
<?php $i=1; ?>
@foreach($sliderImages as $si)
  	<tr>
  		<td style="vertical-align: middle;">{{$i}}</td>
  		<td><img src="{{asset('slider/'.$si->image)}}" width="100%"></td>
  		<td style="vertical-align: middle;">{{$si->title}}</td>
  		<td style="vertical-align: middle;text-align: center;font-size: 20px;">
      <a href="{{route('admin.deleteSliderImage', $si->id)}}" style="color: red;"><i class="fa fa-trash fa-fw"></i></a>  
      </td>
  	</tr>
  <?php $i++; ?>
@endforeach
  </tbody>
  <tfoot>
  	<tr>
  		<td></td>
  		<td></td>
  		<td></td>
  		<td></td>
  	</tr>
  </tfoot>
</table>
</div>

</div><!-- /.box-body -->

<div class="box-footer">
<h5 style="text-align: center;">Slider all images in here.</h5>
</div>
</div><!-- /.box -->
</section>
@endsection