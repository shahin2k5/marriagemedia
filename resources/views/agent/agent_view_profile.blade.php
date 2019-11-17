@extends('admin.app')
@section('content')

<section class="content-header">

<h1>Dashboard
<small>Control panel</small>
</h1>

<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
@if($profileInfo->publish_status=="Unpublished")
<li><a href = "{{route('admin.showAgentUnpublishedUsers')}}">Agent Unpublished Users List</a></li>
@else
<li><a href = "{{route('admin.showAgentPublishedUsers')}}">Agent Published Users List</a></li>
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
<img src="{{asset('profile/'.$profileInfo->photo)}}" width="100%" />
<label>Change Status</label>
@if($profileInfo->publish_status=="Unpublished")
<a href="{{route('admin.changePublishStatusByAgent', $profileInfo->id)}}" class="btn btn-success btn-block">Publish</a>
@else
<a href="{{route('admin.changePublishStatusByAgent', $profileInfo->id)}}" class="btn btn-warning btn-block">Unpublish</a>
@endif
</div>
<div class="col-md-8">
<ul style="list-style-type: none;font-size: 1.2em;color: darkgreen;">
<li>Full Name : {{$profileInfo->full_name or ''}}</li>
<li>Address : {{$profileInfo->address or ''}}</li>
<li>Mobile No : {{$profileInfo->mobile_no or ''}}</li>
<li>Country Name : {{$profileInfo->country or ''}}</li>
<li>Gender : {{$profileInfo->sex or ''}}</li>
<li>Date Of Birth : {{$profileInfo->date_of_birth or ''}}</li>
<li>Height : {{$profileInfo->height or ''}}</li>
<li>Weight : {{$profileInfo->weight or ''}}</li>
<li>Religion : {{$profileInfo->religion or ''}}</li>
<li>Marital Status : {{$profileInfo->marital_status or ''}}</li>
<li>Educational Qualification : {{$profileInfo->education or ''}}</li>
<li>Body Type : {{$profileInfo->body_type or ''}}</li>
<li>Drink : {{$profileInfo->drink or ''}}</li>
<li>Diet : {{$profileInfo->diet or ''}}</li>
<li>Blood Group : {{$profileInfo->blood_group or ''}}</li>
<li>Complexion : {{$profileInfo->complexion or ''}}</li>
<li>Mother Tongue : {{$profileInfo->mother_tongue or ''}}</li>
<li>Age : {{$profileInfo->age or ''}}</li>
<li>Occupation : {{$profileInfo->occupation or ''}}</li>
<li>Annual Income : {{$profileInfo->annual_income or ''}}</li>
<li>Fathers Name : {{$profileInfo->fathers_name or ''}}</li>
<li>Fathers Occupation : {{$profileInfo->fathers_occupation or ''}}</li>
<li>Mothers Name : {{$profileInfo->mothers_name or ''}}</li>
<li>Mothers Occupation : {{$profileInfo->mothers_occupation or ''}}</li>
<li>Siblings : {{$profileInfo->siblings or ''}}</li>
<li>Family Values : {{$profileInfo->family_values or ''}}</li>
</ul>
</div>
</div>

</div><!-- /.box-body -->
</div><!-- /.box -->

</section>
@endsection
