@extends('admin.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.showUncompleteUsers')}}"><i class="fa fa-graduation-cap"></i> Incomplete Clients</a></li>
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
    @include('admin.profiles.tabs')   
  </div>
</div>

</div><!-- /.box-header -->

<div class="box-body">

<h4 class="text-center">About</h4>

<div class="container" style="width: 100%">


<form action="{{route('admin.createAboutForAdmin', $id)}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Height</label>
<!-- <input type="text" name="txtHeight" class="form-control" placeholder="5 feet 10 inch" value="{{$profileInfo->height or ''}}" /> -->
<input type="hidden" name="txtHeightNumeric" id="txtHeightNumeric" class="form-control" value="{{$profileInfo->height_numeric or ''}}" />

<select id="txtHeight" name="optHeight" class="form-control" onchange="selectHeight(this.value)">
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

<script type="text/javascript">

  function selectHeight(opts) {
    if(opts=="4ft"){
      document.getElementById('txtHeightNumeric').value=400;
    }
    if(opts=="4ft 1in"){
     document.getElementById('txtHeightNumeric').value=401; 
    }
    if(opts=="4ft 2in"){
document.getElementById('txtHeightNumeric').value=402;
    }
    if(opts=="4ft 3in"){
document.getElementById('txtHeightNumeric').value=403;
    }
    if(opts=="4ft 4in"){
document.getElementById('txtHeightNumeric').value=404;
    }
    if(opts=="4ft 5in"){
document.getElementById('txtHeightNumeric').value=405;
    }
    if(opts=="4ft 6in"){
document.getElementById('txtHeightNumeric').value=406;
    }
    if(opts=="4ft 7in"){
document.getElementById('txtHeightNumeric').value=407;
    }
    if(opts=="4ft 8in"){
document.getElementById('txtHeightNumeric').value=408;
    }
    if(opts=="4ft 9in"){
document.getElementById('txtHeightNumeric').value=409;
    }
    if(opts=="4ft 10in"){
document.getElementById('txtHeightNumeric').value=410;
    }
    if(opts=="4ft 11in"){
document.getElementById('txtHeightNumeric').value=411;
    }
    if(opts=="5ft"){
document.getElementById('txtHeightNumeric').value=500;
    }
    if(opts=="5ft 1in"){
document.getElementById('txtHeightNumeric').value=501;
    }
    if(opts=="5ft 2in"){
document.getElementById('txtHeightNumeric').value=502;
    }
    if(opts=="5ft 3in"){
document.getElementById('txtHeightNumeric').value=503;
    }
    if(opts=="5ft 4in"){
document.getElementById('txtHeightNumeric').value=504;
    }
    if(opts=="5ft 5in"){
document.getElementById('txtHeightNumeric').value=505;
    }
    if(opts=="5ft 6in"){
document.getElementById('txtHeightNumeric').value=506;
    }
    if(opts=="5ft 7in"){
document.getElementById('txtHeightNumeric').value=507;
    }
    if(opts=="5ft 8in"){
document.getElementById('txtHeightNumeric').value=508;
    }
    if(opts=="5ft 9in"){
document.getElementById('txtHeightNumeric').value=509;
    }
    if(opts=="5ft 10in"){
document.getElementById('txtHeightNumeric').value=510;
    }
    if(opts=="5ft 11in"){
document.getElementById('txtHeightNumeric').value=511;
    }
    if(opts=="6ft"){
document.getElementById('txtHeightNumeric').value=600;
    }
    if(opts=="6ft 1in"){
document.getElementById('txtHeightNumeric').value=601;
    }
    if(opts=="6ft 2in"){
document.getElementById('txtHeightNumeric').value=602;
    }
    if(opts=="6ft 3in"){
document.getElementById('txtHeightNumeric').value=603;
    }
    if(opts=="6ft 4in"){
document.getElementById('txtHeightNumeric').value=604;
    }
    if(opts=="6ft 5in"){
document.getElementById('txtHeightNumeric').value=605;
    }
    if(opts=="6ft 6in"){
document.getElementById('txtHeightNumeric').value=606;
    }
    if(opts=="6ft 7in"){
document.getElementById('txtHeightNumeric').value=607;
    }
    if(opts=="6ft 8in"){
document.getElementById('txtHeightNumeric').value=608;
    }
    if(opts=="6ft 9in"){
document.getElementById('txtHeightNumeric').value=609;
    }
    if(opts=="6ft 10in"){
document.getElementById('txtHeightNumeric').value=610;
    }
    if(opts=="6ft 11in"){
document.getElementById('txtHeightNumeric').value=611;
    }
    if(opts=="7ft"){
document.getElementById('txtHeightNumeric').value=700;
    }
    if(opts=="7ft 1in"){
document.getElementById('txtHeightNumeric').value=701;
    }
    if(opts=="7ft 2in"){
document.getElementById('txtHeightNumeric').value=702;
    }
    if(opts=="7ft 3in"){
document.getElementById('txtHeightNumeric').value=703;
    }
    if(opts=="7ft 4in"){
document.getElementById('txtHeightNumeric').value=704;
    }
    if(opts=="7ft 5in"){
document.getElementById('txtHeightNumeric').value=705;
    }
    if(opts=="7ft 6in"){
document.getElementById('txtHeightNumeric').value=706;
    }
    if(opts=="7ft 7in"){
document.getElementById('txtHeightNumeric').value=707;
    }
    if(opts=="7ft 8in"){
document.getElementById('txtHeightNumeric').value=708;
    }
    if(opts=="7ft 9in"){
document.getElementById('txtHeightNumeric').value=709;
    }
    if(opts=="7ft 10in"){
document.getElementById('txtHeightNumeric').value=710;
    }
    if(opts=="7ft 11in"){
document.getElementById('txtHeightNumeric').value=711;
    }
    
  }
  
</script>

@endsection
