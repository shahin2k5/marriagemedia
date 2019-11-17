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

<h4 class="text-center">Partner Preference</h4>

<div class="container" style="width: 100%">


<form action="{{route('user.insertPreferenceForAdmin', $id)}}" method="post">
  {!! csrf_field() !!}
<div class="box-body">
<div class="row">
  
  <div class="col-md-6">
    <div class="form-group">
      <label>From Age</label>
      <input type="number" name="txtFromAge" class="form-control" placeholder="25"  value="{{$profileInfo->from_age or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>To Age</label>
      <input type="number" name="txtToAge" class="form-control" placeholder="35"  value="{{$profileInfo->to_age or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>From Height</label>
      <input type="text" name="txtFromHeight" class="form-control" placeholder="5ft 10in" value="{{$profileInfo->from_height or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>To Height</label>
      <input type="text" name="txtToHeight" class="form-control" placeholder="6ft 10in" value="{{$profileInfo->to_height or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Religion</label>
      <select name="optReligion" class="form-control">
        <option value="{{$profileInfo->religion or ''}}">{{$profileInfo->religion or 'SELECT'}}</option>
        <option>Muslim</option>
        <option>Christian</option>
        <option>Hindu</option>
        <option>Buddish</option>
      </select>
    </div>
  </div>

 <div class="col-md-6">
   <div class="form-group">
    <label>Marital Status</label>
      <select name="optMaritalStatus" class="form-control ">
        <option value="{{$profileInfo->marital_status or ''}}">{{$profileInfo->marital_status or 'SELECT'}}</option>
        <option>Unmarried</option>
        <option>Married</option>
        <option>Divorced</option>
        <option>Widow</option>
        <option>Separated</option>
      </select>
   </div>
  </div>

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

  <div class="col-md-6">
   <div class="form-group">
    <label>Appearance</label>
      <select name="optAppearance" class="form-control ">
        <option value="{{$profileInfo->appearance or ''}}">{{$profileInfo->appearance or 'SELECT'}}</option>
        <option>Panjabi</option>
        <option>Panjabi Tupi</option>
        <option>Shirt Pant</option>
        <option>Jubba</option>
      </select>
   </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Education</label>
    <input type="text" name="txtEducation" class="form-control" value="{{$profileInfo->education or ''}}" />
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Body Type</label>
      <select name="optBodyType" class="form-control ">
      <option value="{{$profileInfo->body_type or ''}}">{{$profileInfo->body_type or 'SELECT'}}</option>
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
      <label>Drink</label>
      <select name="optDrink" class="form-control ">
        <option value="{{$profileInfo->drink or ''}}">{{$profileInfo->drink or 'SELECT'}}</option>
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
      <option value="{{$profileInfo->smoke or ''}}">{{$profileInfo->smoke or 'SELECT'}}</option>
      <option>Yes</option>
      <option>No</option>
      <option>Occationaly</option>
      <option>Never</option>
    </select>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Diet</label>
    <select name="optDiet" class="form-control">
      <option value="{{$profileInfo->diet or ''}}">{{$profileInfo->diet or 'SELECT'}}</option>
      <option>Non-Vegetarian</option>
      <option>Vegetarian</option>
    </select>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Complexion</label>
    <select name="optComplexion" class="form-control ">
      <option value="{{$profileInfo->complexion or ''}}">{{$profileInfo->complexion or 'SELECT'}}</option>
      <option>Fair</option>
      <option>Very Fair</option>
      <option>Black</option>
    </select>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Occupation</label>
    <input type="text" name="txtOccupation" class="form-control form-check-label" placeholder="Software Engineer, Government Service holder" value="{{$profileInfo->occupation or ''}}" />
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Annual Income From (USD)</label>
    <input type="number" name="txtFromIncome" class="form-control form-check-label" placeholder="3500" value="{{$profileInfo->from_annual_income or ''}}" />
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Annual Income To (USD)</label>
    <input type="number" name="txtToIncome" class="form-control form-check-label" placeholder="3500" value="{{$profileInfo->to_annual_income or ''}}" />
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Country</label>
    <select name="optCountry" id="optCountry" class="form-control form-check-label">
      <option value="{{$profileInfo->country or ''}}">{{$profileInfo->country or 'Select Country'}}</option>
      @foreach($countryList as $cl)
        <option>{{$cl->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>City</label>
    <select name="optCity" id="optCity" class="form-control form-check-label">
      <option value="{{$profileInfo->city or ''}}">{{$profileInfo->city or 'Select City'}}</option>
    </select>
  </div>
</div>

</div><!-- /.row -->
</div><!-- /.box-body -->

<div class="box-footer">
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
