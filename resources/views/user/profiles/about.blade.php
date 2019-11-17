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

<h4 class="text-center">About</h4>

<div class="container" style="width: 100%">


<form action="{{route('user.createAboutForAdmin', $id)}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Height</label>
<!-- <input type="text" name="txtHeight" class="form-control" placeholder="5 feet 10 inch" value="{{$profileInfo->height or ''}}" /> -->
<select id="txtHeight" name="optHeight" class="form-control">
    <option>{{$profileInfo->height or ''}}</option>
    <option>4ft</option>
    @for($i=1; $i< 12; $i++)
    <option>{{"4ft ".$i."in"}}</option>
    @endfor
    <option>5ft</option>
    @for($i=1; $i< 12; $i++)
    <option>{{"5ft ".$i."in"}}</option>
    @endfor
    <option>6ft</option>
    @for($i=1; $i< 12; $i++)
    <option>{{"6ft ".$i."in"}}</option>
    @endfor
    <option>7ft</option>
    @for($i=1; $i< 12; $i++)
    <option>{{"7ft ".$i."in"}}</option>
    @endfor
  </select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Weight</label>
<input type="text" name="txtWeight" class="form-control" placeholder="78 kg" value="{{$profileInfo->weight or ''}}"/>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Body Type</label>
<select name="optBodyType" class="form-control ">
  <option>{{$profileInfo->body_type or ''}}</option>
  <option>Normal</option>
  <option>Slim</option>
  <option>Athletic</option>
  <option>Average</option>
  <option>Fat</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Marital Status</label>
<select name="optMaritalStatus" class="form-control ">
  <option>{{$profileInfo->marital_status or ''}}</option>
  <option>Unmarried</option>
  <option>Married</option>
  <option>Divorced</option>
  <option>Widow</option>
  <option>Separated</option>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Drink</label>
<select name="optDrink" class="form-control ">
  <option>{{$profileInfo->drink or ''}}</option>
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Smoke</label>
<select name="optSmoke" class="form-control ">
  <option>{{$profileInfo->smoke or ''}}</option>
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Diet</label>
<select name="optDiet" class="form-control ">
  <option>{{$profileInfo->diet or ''}}</option>
  <option>Non-Vegetarian</option>
  <option>Vegetarian</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Complexion</label>
<select name="optComplexion" class="form-control ">
  <option>{{$profileInfo->complexion or ''}}</option>
  <option>Fair</option>
  <option>Very Fair</option>
  <option>Black</option>
</select>
</div>
</div>

</div>

<div class="row">
  
  <div class="col-md-6">
   <div class="form-group">
    <label>Beard</label>
      <select name="optBeard" class="form-control ">
        <option value="{{$profileInfo->beard or ''}}">{{$profileInfo->beard or 'SELECT'}}</option>
        <option>Yes</option>
        <option>No</option>
      </select>
   </div>
  </div>

  <div class="col-md-6">
   <div class="form-group">
    <label>Mustache</label>
      <select name="optMustache" class="form-control ">
        <option value="{{$profileInfo->mustache or ''}}">{{$profileInfo->mustache or 'SELECT'}}</option>
        <option>Yes</option>
        <option>No</option>
      </select>
   </div>
  </div>
  
</div>


<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother Tongue</label>
<select name="optMotherTongue" class="form-control ">
  <option value="{{$profileInfo->mother_tongue or ''}}">{{$profileInfo->mother_tongue or 'SELECT'}}</option>
  <option>Bangla</option>
  <option>English</option>
  <option>Hindi</option>
  <option>Urdu</option>
</select>
</div>
</div>

<div class="col-md-6">
   <div class="form-group">
    <label>Appearance</label>
      <select name="optAppearance" class="form-control ">
        <option value="{{$profileInfo->appearance or ''}}">{{$profileInfo->appearance or 'SELECT'}}</option>
        <option>Panjabi</option>
        <option>Panjabi Tupi</option>
        <option>Shirt Pant</option>
        <option>Jubba</option>
        <option>Selowar Kamiz</option>
        <option>Borkha</option>
      </select>
   </div>
  </div>

</div>

<div class="row">
  
<div class="col-md-6">
<div class="form-group">
<label>Created By</label>
<select name="optCreatedBy" class="form-control">
  <option value="{{$profileInfo->added_by or ''}}">{{$profileInfo->added_by or 'SELECT'}}</option>
  <option>Self</option>
  <option>Guardian</option>
  <option>Relative</option>
  <option>Other</option>
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
