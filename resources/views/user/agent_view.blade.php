@extends('user.app')
@section('content')

<section class="content-header">

<h1>Dashboard
<small>Control panel</small>
</h1>

<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
<h3 class="box-title">Agent Assign Package</h3>
<span class="pull-right">
<a href="{{route('user.agentView', $agentList->id)}}">
<i class="fa fa-refresh fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="row">
<div class="col-md-12">
<img src="{{asset('agentimages/'.$agentList->cover_photo)}}" width="100%" height="20%" />
</div>
<div class="col-md-4">
<img src="{{asset('agentimages/'.$agentList->icon)}}" width="70%" style="border: 1px solid #CCC; margin-top: -20%; margin-left: 10%;" />
<form action="{{route('user.insertAssignForAgent')}}" method="post">
	{!! csrf_field() !!}
<input type="hidden" name="hddProfileId" value="{{$agentList->id}}">
<div class="form-group">
<label>Package Name</label>
<select class="form-control" name="optPackageName" id="optPackageName" urlPac = "{{route('user.showPackInfoBy')}}">
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
 		<th colspan="3">Agent Information</th>
 	</tr>
 </thead>
 <tbody>
 	<tr>
 		<td>Full Name</td>
 		<td>:</td>
 		<td>{{$agentList->full_name or ''}}</td>
 	</tr>
 	<tr>
 		<td>Company Name</td>
 		<td>:</td>
 		<td>{{$agentList->company_name or ''}}</td>
 	</tr>
 	<tr>
 		<td>Address</td>
 		<td>:</td>
 		<td>{{$agentList->address or ''}}</td>
 	</tr>
 	<tr>
 		<td>Mobile No</td>
 		<td>:</td>
 		<td>{{$agentList->mobile_no or ''}}</td>
 	</tr>
 	<tr>
 		<td>Status</td>
 		<td>:</td>
 		<td>{{$agentList->status or ''}}</td>
 	</tr>
 	<tr>
 		<td>Paid Status</td>
 		<td>:</td>
 		<td>{{$agentList->paid_status or ''}}</td>
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
