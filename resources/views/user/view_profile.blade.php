@extends('user.app')
@section('content')

<section class="content-header">

<h1>Dashboard
<small>Control panel</small>
</h1>

<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
@if($profileInfo->publish_status=="Unpublished")
<li><a href = "{{route('user.showUnpublishedUsers')}}">Users Unpublished List</a></li>
@else
<li><a href = "{{route('user.showPublishedUsers')}}">Users Published List</a></li>
@endif
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

</div><!-- /.box-header -->

<div class="box-body">

<div class="row">
<div class="col-md-4">
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
@if($profileInfo->publish_status=="Unpublished")
<a href="{{route('user.changePublishStatus', $profileInfo->id)}}" class="btn btn-success btn-block">Publish</a>
@else
<a href="{{route('user.changePublishStatus', $profileInfo->id)}}" class="btn btn-warning btn-block">Unpublish</a>
@endif
</div>
<div class="col-md-8">
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

</section>
@endsection
