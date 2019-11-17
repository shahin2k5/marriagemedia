@extends('client.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Complete Profile</li>
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
    @include('client.profiles.tabs')   
  </div>
</div>

</div><!-- /.box-header -->

<div class="box-body">

<h4 class="text-center">Family Information</h4>

<div class="container" style="width: 100%">



<form action="{{route('client.createFamily')}}" method="post">
  {!! csrf_field() !!}
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Name</label>
<input type="text" name="txtFathersName" class="form-control" placeholder="Fathers Name" value="{{$profileInfo->fathers_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Occupation</label>
<input type="text" name="txtFathersOccupation" class="form-control" placeholder="Fathers Occupation"  value="{{$profileInfo->fathers_occupation or ''}}" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Name</label>
<input type="text" name="txtMothersName" class="form-control" placeholder="Mothers Name" value="{{$profileInfo->mothers_name or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Occupation</label>
<input type="text" name="txtMothersOccupation" class="form-control" placeholder="Mothers Occupation"  value="{{$profileInfo->mothers_occupation or ''}}" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Siblings</label>
<input type="text" name="txtSiblings" class="form-control" placeholder="3 brothers and 2 sisters" value="{{$profileInfo->siblings or ''}}" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Family Values</label>
<select name="optFamilyValues" class="form-control">
@if($profileInfo->family_values=="High Class")
  <option>High Class</option>
  <option>High Middle Class</option>
  <option>Middle Class</option>
@elseif($profileInfo->family_values=="High Middle Class")
  <option>High Middle Class</option>
  <option>Middle Class</option>
  <option>High Class</option>
@else
  <option>Middle Class</option>
  <option>High Class</option>
  <option>High Middle Class</option>
@endif
</select>
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
