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

<h4 class="text-center">Partner Preference</h4>

<div class="container" style="width: 100%">


<form action="{{route('admin.insertPreferenceForAdmin', $profileInfo->id)}}" method="post">
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
      <input type="hidden" name="txtFromHeightNumeric" id="txtFromHeightNumeric" class="form-control" value="{{$profileInfo->from_height_numeric or ''}}" />

      <select id="txtFromHeight" name="txtFromHeight" class="form-control" onchange="selectFromHeight(this.value)">
        <option value="{{$profileInfo->from_height or ''}}">{{$profileInfo->from_height or 'Select'}}</option>
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
      <label>To Height</label>
      <input type="hidden" name="txtToHeightNumeric" id="txtToHeightNumeric" class="form-control" value="{{$profileInfo->to_height_numeric or ''}}" />

      <select id="txtToHeight" name="txtToHeight" class="form-control" onchange="selectToHeight(this.value)">
        <option value="{{$profileInfo->to_height or ''}}">{{$profileInfo->to_height or 'Select'}}</option>
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



<script type="text/javascript">

  function selectFromHeight(opts) {
    if(opts=="4ft"){
      document.getElementById('txtFromHeightNumeric').value=400;
    }
    if(opts=="4ft 1in"){
     document.getElementById('txtFromHeightNumeric').value=401; 
    }
    if(opts=="4ft 2in"){
document.getElementById('txtFromHeightNumeric').value=402;
    }
    if(opts=="4ft 3in"){
document.getElementById('txtFromHeightNumeric').value=403;
    }
    if(opts=="4ft 4in"){
document.getElementById('txtFromHeightNumeric').value=404;
    }
    if(opts=="4ft 5in"){
document.getElementById('txtFromHeightNumeric').value=405;
    }
    if(opts=="4ft 6in"){
document.getElementById('txtFromHeightNumeric').value=406;
    }
    if(opts=="4ft 7in"){
document.getElementById('txtFromHeightNumeric').value=407;
    }
    if(opts=="4ft 8in"){
document.getElementById('txtFromHeightNumeric').value=408;
    }
    if(opts=="4ft 9in"){
document.getElementById('txtFromHeightNumeric').value=409;
    }
    if(opts=="4ft 10in"){
document.getElementById('txtFromHeightNumeric').value=410;
    }
    if(opts=="4ft 11in"){
document.getElementById('txtFromHeightNumeric').value=411;
    }
    if(opts=="5ft"){
document.getElementById('txtFromHeightNumeric').value=500;
    }
    if(opts=="5ft 1in"){
document.getElementById('txtFromHeightNumeric').value=501;
    }
    if(opts=="5ft 2in"){
document.getElementById('txtFromHeightNumeric').value=502;
    }
    if(opts=="5ft 3in"){
document.getElementById('txtFromHeightNumeric').value=503;
    }
    if(opts=="5ft 4in"){
document.getElementById('txtFromHeightNumeric').value=504;
    }
    if(opts=="5ft 5in"){
document.getElementById('txtFromHeightNumeric').value=505;
    }
    if(opts=="5ft 6in"){
document.getElementById('txtFromHeightNumeric').value=506;
    }
    if(opts=="5ft 7in"){
document.getElementById('txtFromHeightNumeric').value=507;
    }
    if(opts=="5ft 8in"){
document.getElementById('txtFromHeightNumeric').value=508;
    }
    if(opts=="5ft 9in"){
document.getElementById('txtFromHeightNumeric').value=509;
    }
    if(opts=="5ft 10in"){
document.getElementById('txtFromHeightNumeric').value=510;
    }
    if(opts=="5ft 11in"){
document.getElementById('txtFromHeightNumeric').value=511;
    }
    if(opts=="6ft"){
document.getElementById('txtFromHeightNumeric').value=600;
    }
    if(opts=="6ft 1in"){
document.getElementById('txtFromHeightNumeric').value=601;
    }
    if(opts=="6ft 2in"){
document.getElementById('txtFromHeightNumeric').value=602;
    }
    if(opts=="6ft 3in"){
document.getElementById('txtFromHeightNumeric').value=603;
    }
    if(opts=="6ft 4in"){
document.getElementById('txtFromHeightNumeric').value=604;
    }
    if(opts=="6ft 5in"){
document.getElementById('txtFromHeightNumeric').value=605;
    }
    if(opts=="6ft 6in"){
document.getElementById('txtFromHeightNumeric').value=606;
    }
    if(opts=="6ft 7in"){
document.getElementById('txtFromHeightNumeric').value=607;
    }
    if(opts=="6ft 8in"){
document.getElementById('txtFromHeightNumeric').value=608;
    }
    if(opts=="6ft 9in"){
document.getElementById('txtFromHeightNumeric').value=609;
    }
    if(opts=="6ft 10in"){
document.getElementById('txtFromHeightNumeric').value=610;
    }
    if(opts=="6ft 11in"){
document.getElementById('txtFromHeightNumeric').value=611;
    }
    if(opts=="7ft"){
document.getElementById('txtFromHeightNumeric').value=700;
    }
    if(opts=="7ft 1in"){
document.getElementById('txtFromHeightNumeric').value=701;
    }
    if(opts=="7ft 2in"){
document.getElementById('txtFromHeightNumeric').value=702;
    }
    if(opts=="7ft 3in"){
document.getElementById('txtFromHeightNumeric').value=703;
    }
    if(opts=="7ft 4in"){
document.getElementById('txtFromHeightNumeric').value=704;
    }
    if(opts=="7ft 5in"){
document.getElementById('txtFromHeightNumeric').value=705;
    }
    if(opts=="7ft 6in"){
document.getElementById('txtFromHeightNumeric').value=706;
    }
    if(opts=="7ft 7in"){
document.getElementById('txtFromHeightNumeric').value=707;
    }
    if(opts=="7ft 8in"){
document.getElementById('txtFromHeightNumeric').value=708;
    }
    if(opts=="7ft 9in"){
document.getElementById('txtFromHeightNumeric').value=709;
    }
    if(opts=="7ft 10in"){
document.getElementById('txtFromHeightNumeric').value=710;
    }
    if(opts=="7ft 11in"){
document.getElementById('txtFromHeightNumeric').value=711;
    }
    
  }






  function selectToHeight(opts) {
    if(opts=="4ft"){
      document.getElementById('txtToHeightNumeric').value=400;
    }
    if(opts=="4ft 1in"){
     document.getElementById('txtToHeightNumeric').value=401; 
    }
    if(opts=="4ft 2in"){
document.getElementById('txtToHeightNumeric').value=402;
    }
    if(opts=="4ft 3in"){
document.getElementById('txtToHeightNumeric').value=403;
    }
    if(opts=="4ft 4in"){
document.getElementById('txtToHeightNumeric').value=404;
    }
    if(opts=="4ft 5in"){
document.getElementById('txtToHeightNumeric').value=405;
    }
    if(opts=="4ft 6in"){
document.getElementById('txtToHeightNumeric').value=406;
    }
    if(opts=="4ft 7in"){
document.getElementById('txtToHeightNumeric').value=407;
    }
    if(opts=="4ft 8in"){
document.getElementById('txtToHeightNumeric').value=408;
    }
    if(opts=="4ft 9in"){
document.getElementById('txtToHeightNumeric').value=409;
    }
    if(opts=="4ft 10in"){
document.getElementById('txtToHeightNumeric').value=410;
    }
    if(opts=="4ft 11in"){
document.getElementById('txtToHeightNumeric').value=411;
    }
    if(opts=="5ft"){
document.getElementById('txtToHeightNumeric').value=500;
    }
    if(opts=="5ft 1in"){
document.getElementById('txtToHeightNumeric').value=501;
    }
    if(opts=="5ft 2in"){
document.getElementById('txtToHeightNumeric').value=502;
    }
    if(opts=="5ft 3in"){
document.getElementById('txtToHeightNumeric').value=503;
    }
    if(opts=="5ft 4in"){
document.getElementById('txtToHeightNumeric').value=504;
    }
    if(opts=="5ft 5in"){
document.getElementById('txtToHeightNumeric').value=505;
    }
    if(opts=="5ft 6in"){
document.getElementById('txtToHeightNumeric').value=506;
    }
    if(opts=="5ft 7in"){
document.getElementById('txtToHeightNumeric').value=507;
    }
    if(opts=="5ft 8in"){
document.getElementById('txtToHeightNumeric').value=508;
    }
    if(opts=="5ft 9in"){
document.getElementById('txtToHeightNumeric').value=509;
    }
    if(opts=="5ft 10in"){
document.getElementById('txtToHeightNumeric').value=510;
    }
    if(opts=="5ft 11in"){
document.getElementById('txtToHeightNumeric').value=511;
    }
    if(opts=="6ft"){
document.getElementById('txtToHeightNumeric').value=600;
    }
    if(opts=="6ft 1in"){
document.getElementById('txtToHeightNumeric').value=601;
    }
    if(opts=="6ft 2in"){
document.getElementById('txtToHeightNumeric').value=602;
    }
    if(opts=="6ft 3in"){
document.getElementById('txtToHeightNumeric').value=603;
    }
    if(opts=="6ft 4in"){
document.getElementById('txtToHeightNumeric').value=604;
    }
    if(opts=="6ft 5in"){
document.getElementById('txtToHeightNumeric').value=605;
    }
    if(opts=="6ft 6in"){
document.getElementById('txtToHeightNumeric').value=606;
    }
    if(opts=="6ft 7in"){
document.getElementById('txtToHeightNumeric').value=607;
    }
    if(opts=="6ft 8in"){
document.getElementById('txtToHeightNumeric').value=608;
    }
    if(opts=="6ft 9in"){
document.getElementById('txtToHeightNumeric').value=609;
    }
    if(opts=="6ft 10in"){
document.getElementById('txtToHeightNumeric').value=610;
    }
    if(opts=="6ft 11in"){
document.getElementById('txtToHeightNumeric').value=611;
    }
    if(opts=="7ft"){
document.getElementById('txtToHeightNumeric').value=700;
    }
    if(opts=="7ft 1in"){
document.getElementById('txtToHeightNumeric').value=701;
    }
    if(opts=="7ft 2in"){
document.getElementById('txtToHeightNumeric').value=702;
    }
    if(opts=="7ft 3in"){
document.getElementById('txtToHeightNumeric').value=703;
    }
    if(opts=="7ft 4in"){
document.getElementById('txtToHeightNumeric').value=704;
    }
    if(opts=="7ft 5in"){
document.getElementById('txtToHeightNumeric').value=705;
    }
    if(opts=="7ft 6in"){
document.getElementById('txtToHeightNumeric').value=706;
    }
    if(opts=="7ft 7in"){
document.getElementById('txtToHeightNumeric').value=707;
    }
    if(opts=="7ft 8in"){
document.getElementById('txtToHeightNumeric').value=708;
    }
    if(opts=="7ft 9in"){
document.getElementById('txtToHeightNumeric').value=709;
    }
    if(opts=="7ft 10in"){
document.getElementById('txtToHeightNumeric').value=710;
    }
    if(opts=="7ft 11in"){
document.getElementById('txtToHeightNumeric').value=711;
    }
    
  }


  
</script>

@endsection
