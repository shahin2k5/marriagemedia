@extends('admin.app')
@section('content')

<section class="content-header">

<h1>Dashboard
<small>Control panel</small>
</h1>

<ol class="breadcrumb">
<li><a href="{{route('admin.showAllUsers')}}"><i class="fa fa-graduation-cap"></i> All Clients</a></li>
<li class="active">View Profile</li>
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
<h3 class="box-title">View Profile</h3>
<a href="{{route('admin.showAllUsers')}}" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i></a>
</div><!-- /.box-header -->

<div class="box-body">

<div class="row">
<div class="col-md-3">
@if($profileInfo->photo==NULL)
@if($profileInfo->sex=="Male")
<img src="{{asset('image/man.jpg')}}" width="100%" /><br/><br/>
@else
<img src="{{asset('image/woman.jpg')}}" width="100%" /><br/><br/>
@endif
@else
<img src="{{asset('profile/'.$profileInfo->photo)}}" width="100%" /><br/><br/>
@endif
<label>Change Status</label>
<a href="{{route('admin.showProfileForEdit', $profileInfo->id)}}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit</a>
@if($profileInfo->Emails->active==1)
<a href="{{route('admin.changeActiveStatus', $profileInfo->id)}}" class="btn btn-warning btn-block"><i class="fa fa-ban"></i> Deactive</a>
@else
<a href="{{route('admin.changeActiveStatus', $profileInfo->id)}}" class="btn btn-success btn-block"><i class="fa fa-ok"></i> Active</a>
@endif


<a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal">Recieve Payment</a>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<form action="{{route('admin.receivePayment', $profileInfo->id)}}" method="post">
  {!! csrf_field() !!}
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h4 class="modal-title" id="myModalLabel">
Send Payment
</h4>
</div>

<div class="modal-body">

<div class="form-group">
<label>Packages</label>
<select class="form-control" name="optPackages" id="optPackages" required>
  <option value="">SELECT</option>
  @foreach($packages as $package)
  <option value="{{$package->id}}">{{$package->name}}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<label>Payment Method</label>
<select class="form-control" name="optPaymentMethod" id="optPaymentMethod" required>
  <option value="">SELECT</option>
  <option>Cash</option>
  <option>Mobile</option>
</select>
</div>

<div class="form-group">
<label>Mobile No</label>
<input type="number" name="txtMobileNo" id="txtMobileNo" class="form-control" />
</div>

<div class="form-group">
<label>Transaction ID</label>
<input type="number" name="txtTransId" id="txtTransId" class="form-control" />
</div>

<div class="form-group">
<label>Amount</label>
<input type="number" name="txtAmount" id="txtAmount" class="form-control" required />
</div>

</div><!-- End modal-body -->

<div class="modal-footer">
  <button type="submit" class="btn btn-primary">
Send
</button>
<button type="button" class="btn btn-danger"
data-dismiss="modal">Close
</button>
</div>
</div>
</div><!-- /.modal-content -->
</form>
</div><!-- /.modal -->



</div>
<div class="col-md-9">
<table class="table table-bordered">
 <thead>
   <tr>
      <th colspan="2">Profile ID : {{$profileInfo->id}}</th>
      <th>Complete : {{$completePercent or '0'}}%</th>
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
   <tr>
     <td>Paid Status</td>
     <td>:</td>
     <td>{{$profileInfo->paid_status or ''}}</td>
   </tr>
 </tbody>
</table>
</div>
</div>

</div><!-- /.box-body -->
</div><!-- /.box -->

<script src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#optPackages').on('click', function(e){
      e.preventDefault();
      var package_id = $(this).val();
      $.ajax({
        url:"{{route('admin.getDataByPackageId')}}",
        method:"GET",
        dataType:"json",
        data:{package_id:package_id},
        success:function(data){
          console.log(data);
          $("#txtAmount").val(data.packageInfo.price);
        },
        error:function(data){
          alert(data);
        }
      });
    });


    $('#optPaymentMethod').on('change', function(e){
      e.preventDefault();
      if($(this).val()=="Cash"){
        $('#txtMobileNo').attr('disabled', true);
        $('#txtTransId').attr('disabled', true);
      }else{
        $('#txtMobileNo').attr('disabled', false);
        $('#txtTransId').attr('disabled', false);
      }
    });

  });
</script>

</section>
@endsection
