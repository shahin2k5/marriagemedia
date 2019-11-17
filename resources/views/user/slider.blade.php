@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Slider</li>
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
<h3 class="box-title">Slider Image</h3>
<a href="{{route('user.showSliderList')}}" class="btn btn-warning btn-sm pull-right">
<i class="fa fa-th"></i> Slider List
</a>
</div><!-- /.box-header -->
<!-- form start -->
<form action="{{route('user.createSlider')}}" method="post"  enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="box-body">
 <div class="row">
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="flSliderImage">Slider Image:</label>
    <input type="file" name = "flSliderImage"  class="form-control" id="flSliderImage" autofocus="autofocus" required="required" />
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label for="txtSliderText">Slider Text:</label>
    <input type="text" class="form-control" name="txtSliderText" id="txtSliderText">
  </div>
  </div>

</div>
</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-block">Add Slide Image</button>
</div>
</form>
</div><!-- /.box -->
</section>
@endsection