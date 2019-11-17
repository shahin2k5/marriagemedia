@extends('admin.app')
@section('content')

<section class="content-header">

<h1>Dashboard
<small>Control panel</small>
</h1>

<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Assign Package</li>
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
<h3 class="box-title">Assign Package</h3>
</div><!-- /.box-header -->

<div class="box-body">

<div class="row">
<div class="col-md-4">
@if($profileInfo->photo==NULL)
@if($profileInfo->sex=="Male")
<img src="{{asset('image/man.jpg')}}" width="100%" />
@else
<img src="{{asset('image/woman.jpg')}}" width="100%" />
@endif
@else
<img src="{{asset('profile/'.$profileInfo->photo)}}" width="100%" />
@endif
<form action="{{route('admin.insertAssign', 'Client')}}" method="post">
	{!! csrf_field() !!}
<input type="hidden" name="hddProfileId" value="{{$profileInfo->id}}">
<div class="form-group">
<label>Package Name</label>
<select class="form-control" name="optPackageName" id="optPackageName" urlPac = "{{route('admin.showPackInfoBy')}}">
	<option value="">Select Package</option>
	@foreach($packages as $package)
	<option value="{{$package->id}}">{{$package->name}}</option>
	@endforeach
</select>
</div>

<div class="form-group">
<label>Validity Days</label>
<input type="text" name="txtValidityDays" id="txtValidityDays" class="form-control" readonly />
</div>

<div class="form-group">
<label>Price</label>
<input type="number" name="txtPrice" id="txtPrice" class="form-control" readonly />
</div>

<div class="form-group">
<label>Expire Date</label>
<input type="date" name="dtExpireDate" id="dtExpireDate" class="form-control" required />
</div>

<div class="form-group">
<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#myModal">Assign</button>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h4 class="modal-title" id="myModalLabel">
Payment Receive
</h4>
</div>

<div class="modal-body">

<div class="form-group">
<label>Payment Method</label>
<select class="form-control" name="optPaymentMethod" required>
  <option value="">SELECT</option>
  <option>Cash</option>
  <option>Mobile</option>
</select>
</div>


<div class="form-group">
<label>Mobile No</label>
<input type="number" name="txtMobileNo" class="form-control" />
</div>


<div class="form-group">
<label>Transaction ID</label>
<input type="number" name="txtTransId" class="form-control" />
</div>

<div class="form-group">
<label>Amount</label>
<input type="number" name="txtAmount" class="form-control" required />
</div>

</div><!-- End modal-body -->

<div class="modal-footer">
<button type="button" class="btn btn-danger"
data-dismiss="modal">Close
</button>
<button type="submit" class="btn btn-primary">
Apply Charge
</button>
</div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal -->


</form>
</div>
<div class="col-md-8">
<table class="table table-bordered">
 <thead>
   <tr>
      <th colspan="3">Profile View</th>
   </tr>
 </thead>
 <tbody>
   <tr>
     <td>Full Name</td>
     <td>:</td>
     <td>{{$profileInfo->full_name or ''}}</td>
   </tr>
   <tr>
     <td>Address</td>
     <td>:</td>
     <td>{{$profileInfo->address or ''}}</td>
   </tr>
   <tr>
     <td>Mobile No</td>
     <td>:</td>
     <td>{{$profileInfo->mobile_no or ''}}</td>
   </tr>
   <tr>
     <td>Country Name</td>
     <td>:</td>
     <td>{{$profileInfo->country or ''}}</td>
   </tr>
   <tr>
     <td>Gender</td>
     <td>:</td>
     <td>{{$profileInfo->sex or ''}}</td>
   </tr>
   <tr>
     <td>Date Of Birth</td>
     <td>:</td>
     <td>{{$profileInfo->date_of_birth or ''}}</td>
   </tr>
   <tr>
     <td>Height</td>
     <td>:</td>
     <td>{{$profileInfo->height or ''}}</td>
   </tr>
   <tr>
     <td>Weight</td>
     <td>:</td>
     <td>{{$profileInfo->weight or ''}}</td>
   </tr>
   <tr>
     <td>Religion</td>
     <td>:</td>
     <td>{{$profileInfo->religion or ''}}</td>
   </tr>
   <tr>
     <td>Marital Status</td>
     <td>:</td>
     <td>{{$profileInfo->marital_status or ''}}</td>
   </tr>
   <tr>
     <td>Educational Qualification</td>
     <td>:</td>
     <td>{{$profileInfo->education or ''}}</td>
   </tr>
   <tr>
     <td>Body Type</td>
     <td>:</td>
     <td>{{$profileInfo->body_type or ''}}</td>
   </tr>
   <tr>
     <td>Drink</td>
     <td>:</td>
     <td>{{$profileInfo->drink or ''}}</td>
   </tr>
   <tr>
     <td>Diet</td>
     <td>:</td>
     <td>{{$profileInfo->diet or ''}}</td>
   </tr>
   <tr>
     <td>Blood Group</td>
     <td>:</td>
     <td>{{$profileInfo->blood_group or ''}}</td>
   </tr>
   <tr>
     <td>Complexion</td>
     <td>:</td>
     <td>{{$profileInfo->complexion or ''}}</td>
   </tr>
   <tr>
     <td>Mother Tongue</td>
     <td>:</td>
     <td>{{$profileInfo->mother_tongue or ''}}</td>
   </tr>
   <tr>
     <td>Age</td>
     <td>:</td>
     <td>{{$profileInfo->age or ''}}</td>
   </tr>
   <tr>
     <td>Occupation</td> 
     <td>:</td>
     <td>{{$profileInfo->occupation or ''}}</td>
   </tr>
   <tr>
     <td>Annual Income</td>
     <td>:</td>
     <td>{{$profileInfo->annual_income or ''}}</td>
   </tr>
   <tr>
     <td>Fathers Name</td>
     <td>:</td>
     <td>{{$profileInfo->fathers_name or ''}}</td>
   </tr>
   <tr>
     <td>Fathers Occupation</td>
     <td>:</td>
     <td>{{$profileInfo->fathers_occupation or ''}}</td>
   </tr>
   <tr>
     <td>Mothers Name</td>
     <td>:</td>
     <td>{{$profileInfo->mothers_name or ''}}</td>
   </tr>
   <tr>
     <td>Mothers Occupation</td>
     <td>:</td>
     <td>{{$profileInfo->mothers_occupation or ''}}</td>
   </tr>
   <tr>
     <td>Siblings</td>
     <td>:</td>
     <td>{{$profileInfo->siblings or ''}}</td>
   </tr>
   <tr>
     <td>Family Values</td>
     <td>:</td>
     <td>{{$profileInfo->family_values or ''}}</td>
   </tr>
 </tbody>
</table>
</div>
</div>

</div><!-- /.box-body -->
</div><!-- /.box -->

</section>
@endsection
<script type="text/javascript" src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
 
 $("#optPackageName").on('change', function(){
 	var package_id = $(this).val();
 	var urls = $(this).attr("urlPac");
 	//alert('yes');
  if(package_id==""){
    $("#txtValidityDays").val("");
    $("#txtPrice").val(""); 
    $("#dtExpireDate").val("");
  }

 	$.ajax({
 		url: urls,
 		method: "GET",
 		data:{packageId:package_id},
 		success: function(result){
            // $("#div1").html(result);
            // alert(result.success);
            if(result.packages){

            $("#txtValidityDays").val(result.packages.validity_days);
            $("#txtPrice").val(result.packages.price);
            $("#dtExpireDate").val(result.expire_date);
            }else{
            $("#txtValidityDays").val("");
            $("#txtPrice").val("");	
            $("#dtExpireDate").val("");
            }
            
		}

 	});
 });

});
</script>
