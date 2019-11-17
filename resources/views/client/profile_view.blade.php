@extends('client.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Dashboard
<small>Profile</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
<li class="active">Profile View</li>
</ol>
</section>

<!-- Main content -->
<section class="content">


<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Profile View</h3>

@if(!empty($assignPackage))
  <span class="text-success">(Paid Profile)</span>
@elseif(!empty($agentAssignPk))
  <span class="text-success">(Paid Profile)</span>
@else
  <span class="text-red" style="font-size: 12px;"><strong>(Make payment to active profile)</strong></span>
@endif

<span class="pull-right">
 <a href="{{route('client.showClientProfile')}}" class="btn btn-primary btn-sm"><i class="fa fa-eye fa-fw"></i> Public View</a>
 <a href="{{route('client.showClientProfile')}}" class="btn btn-success btn-sm"><i class="fa fa-edit fa-fw"></i></a>
 <a href="{{route('client.dashboard')}}" class="btn btn-warning btn-sm"><i class="fa fa-refresh fa-fw"></i></a>
</span>
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

<a href="#" style="margin-bottom: 5%;text-align: left;" data-toggle = "modal" data-target="#changePicModal" class="btn btn-default btn-block"><i class="fa fa-user fa-fw"></i> Change Photo</a>



<!-- Start Modal -->
<div class="modal fade" id="changePicModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<form action="{{route('client.changePicture')}}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h4 class="modal-title" id="myModalLabel">
Change Photo
</h4>
</div>

<div class="modal-body">

<input type="hidden" name="txtProfileId" value="{{$profileInfo->id}}" />

<div class="form-group">

<input type="file" name="flPhoto" class="form-control" required="required" autofocus="autofocus" />
</div>


</div><!-- End modal-body -->

<div class="modal-footer">
  <button type="submit" class="btn btn-primary">
Save
</button>
<button type="button" class="btn btn-danger"
data-dismiss="modal">Close
</button>
</div>
</div>
</div><!-- /.modal-content -->
</form>
</div><!-- /.modal -->


<!-- End Modal -->



<a href="{{route('client.showPersonalInformation')}}" style="text-align: left;" class="btn btn-success btn-block"><i class="fa fa-edit fa-fw"></i> Edit Profile</a>
<a href="{{route('client.showFollowers')}}" style="text-align: left;" class="btn btn-primary btn-block"><i class="fa fa-users fa-fw"></i> Followers</a>
<a href="{{route('client.showProposals')}}" style="text-align: left;" class="btn btn-info btn-block"><i class="fa fa-book fa-fw"></i> Proposals</a>
<a href="{{route('client.showViewers')}}" style="text-align: left;" class="btn btn-warning btn-block"><i class="fa fa-eye fa-fw"></i> Viewers</a>

@if(!empty($assignPackage))
 
@elseif(!empty($agentAssignPk))

@else
  <a href="#" style="text-align: left;" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModalPayments"><i class="fa fa-credit-card fa-fw"></i> Make Payment</a>


<!-- Modal -->
<div class="modal fade" id="myModalPayments" role="dialog" aria-hidden="true">
<form action="{{route('client.insertPaymentDetails')}}" method="post">
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
<select class="form-control" name="optPackages" required>
  <option value="">SELECT</option>
  @foreach($packages as $package)
  <option value="{{$package->id}}">{{$package->name}}</option>
  @endforeach
</select>
</div>

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


@endif

<a href="{{route('client.showPreference')}}" class="btn btn-default btn-block bg-blue" style="text-align: left;"><i class="fa fa-briefcase fa-fw"></i> Preference</a>

</div>
<div class="col-md-9">
<table class="table table-bordered">
 <thead>
   <tr>
    
      <th colspan="2">Profile ID : {{$profileInfo->id}}

        @if(!empty($assignPackage))
          <span class="text-success">Package : {{$assignPackage->Package->name}}</span>
        @elseif(!empty($agentAssignPk))
          <span class="text-success">Package : {{$agentAssignPk->Package->name}}</span>
        @else
          <span class="text-red" style="font-size: 12px;"><strong>(No Package Selected)</strong></span>
        @endif

      </th>
    
      <th>Complete : {{$completePercent or '0'}}%</th>
   </tr>
 </thead>
 <tbody>
   <tr>
     <td>Full Name </td>
     <td>:</td>
     <td>{{$profileInfo->full_name or ''}}</td>
   </tr>
   <tr>
     <td>Fathers Name </td>
     <td>:</td>
     <td>{{$profileInfo->fathers_name or ''}}</td>
   </tr>
   <tr>
     <td>Fathers Occupation </td>
     <td>:</td>
     <td>{{$profileInfo->fathers_occupation or ''}}</td>
   </tr>
   <tr>
     <td>Mothers Name </td>
     <td>:</td>
     <td>{{$profileInfo->mothers_name or ''}}</td>
   </tr>
   <tr>
     <td>Mothers Occupation </td>
     <td>:</td>
     <td>{{$profileInfo->mothers_occupation or ''}}</td>
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
     <td>Present Address </td>
     <td>:</td>
     <td>{{$profileInfo->address or ''}}</td>
   </tr>
   <tr>
     <td>Permanent Address </td>
     <td>:</td>
     <td>{{$profileInfo->permanent_address or ''}}</td>
   </tr>
   <tr>
     <td>City </td>
     <td>:</td>
     <td>{{$profileInfo->city or ''}}</td>
   </tr>
 </tbody>
</table>
</div>
</div>

</div><!-- /.box-body -->
</div><!-- /.box -->


</section><!-- /.content -->


@endsection
