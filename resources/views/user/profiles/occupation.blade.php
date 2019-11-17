@extends('user.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.showUncompleteUsers')}}"><i class="fa fa-graduation-cap"></i> Incomplete Clients</a></li>
<li class="active">Edit Profile</li>
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
  
<div class="row">
  <div class="col-md-12">
    <h3 class="box-title">Edit Profile</h3>
  </div>
  <div class="col-md-12">
    @include('user.profiles.tabs')   
  </div>
</div>

</div><!-- /.box-header -->

<div class="box-body">

<h4 class="text-center">Occupation</h4>

<div class="container" style="width: 100%">


<form action="{{route('user.createOccupationForAdmin', $id)}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Occupation</label>
<input type="text" name="txtOccupation" class="form-control form-check-label" placeholder="Software Engineer, Government Service holder" value="{{$profileInfo->occupation or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Annual Income (USD)</label>
<input type="number" name="txtIncome" class="form-control form-check-label" placeholder="3500" value="{{$profileInfo->annual_income or ''}}" />
</div>
</div>

</div>

<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>



</div>

</div><!-- /.box-body -->

<div class="box-footer" style="text-align: center;color:orange;">
Please complete your profile in order to display in this matrimony website.
</div>
</div><!-- /.box -->
</section>
@endsection
