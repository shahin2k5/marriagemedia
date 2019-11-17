@extends('agent.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('agent.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
    @include('agent.profiles.tabs')   
  </div>
</div>

</div><!-- /.box-header -->

<div class="box-body">

<h4 class="text-center">Finish</h4>

<div class="container" style="width: 100%">


<form action="{{route('agent.createEducationForAgent', $profileInfo->id)}}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Photo</label> {{$profileInfo->photo or ''}}
    <input type="file" name="flPhoto" class="form-control">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Education</label>
    <input type="text" name="txtEducation" class="form-control" value="{{$profileInfo->education or ''}}" >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <label>Profile Status</label>
    <select class="form-control" name="optStatus">
@if($profileInfo->profile_status=="Public")
      <option>Public</option>
      <option>Private</option>
      <option>Protected</option>
@elseif($profileInfo->profile_status=="Private")
      <option>Private</option>
      <option>Public</option>
      <option>Protected</option>
@elseif($profileInfo->profile_status=="Protected")
      <option>Protected</option>
      <option>Public</option>
      <option>Private</option>
@else
      <option>Public</option>
      <option>Private</option>
      <option>Protected</option>
@endif
    </select>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Mobile No</label>
      <input type="number" name="txtMobileNo" class="form-control" value="{{$profileInfo->mobile_no or ''}}" />
    </div>
  </div>
</div>
<div class="row">
  
  <div class="col-md-6">
    <div class="form-group">
      <label>Present Address</label>
      <textarea name="txtAddress" class="form-control" >{{$profileInfo->address or ''}}</textarea>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Permanent Address</label>
      <textarea name="txtPermanentAddress" class="form-control" >{{$profileInfo->permanent_address or ''}}</textarea>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-6">
    <div class="form-group">
    <label>Country Name</label>
    <select class="form-control" name="optCountryName" id="optCountry">
      <option value="{{$profileInfo->country or ''}}">{{$profileInfo->country or 'SELECT COUNTRY'}}</option>
      @foreach($countryList as $cl)
      <option>{{$cl->name}}</option>
      @endforeach
    </select>
    </div>
  </div>

  <div class="col-md-6">
  <div class="form-group">
    <label>City</label>
    <select name="txtCity" id="optCity" class="form-control form-check-label" placeholder="Dhaka, Chottogram" value="">
      <option value="{{$profileInfo->city or ''}}">{{$profileInfo->city or 'SELECT CITY'}}</option>
    </select>
  </div>
  </div>


</div>
<div class="form-group">
      <button type="submit" class="btn btn-warning pull-right">Save & Finish</button>
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

<script src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("#optCountry").on('change', function(e){
      e.preventDefault();
      var country = $(this).val();
      // alert('yes');
      $.ajax({
        url:"{{route('client.showCityForClient')}}",
        method:"GET",
        data:{country:country},
        success:function(data){
          console.log(data.cityList);
          $("#optCity").html('');
          if(data.cityList!=''){

          $.each(data.cityList, function(key, value){
            
            $("#optCity").append("<option>"+value.city_name+"</option>");
           
            
          });

           }
          else{

              $("#optCity").append("<option value=''>Select City</option>");
            }
          
        }
      });
    });


  });
</script>

@endsection
