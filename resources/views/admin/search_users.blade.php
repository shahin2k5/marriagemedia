@extends('admin.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="{{route('admin.showSliderImage')}}">All Users</a></li>
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

<div class="box box-primary">
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title">
	<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion2-"><i class="fa fa-search fa-fw"></i> Advanced Search <i class="fa fa-angle-down"> </i></button>
</div>
<p><!-- /.accordion-title -->
</p><div id="accordion2-" class="jb-accordion-content collapse ">

<div class="box-body">
<form action="" method="post">
{!! csrf_field() !!}

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>From Date</label>
<input type="date" name="txtFromDate" class="form-control" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>To Date</label>
<input type="date" name="txtToDate" class="form-control" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Search Text</label>
<input type="text" name="txtSearchText" class="form-control" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Field Name</label>
<select name="optFieldName" class="form-control">
<option value=""></option>
<option value="full_name">Full Name</option>
<option value="sex">Gender</option>
<option value="religion">Religion</option>
<option value="marital_status">Marital Status</option>
<option value="education">Education</option>
<option value="body_type">Body Type</option>
<option value="drink">Drink</option>
<option value="smoke">Smoke</option>
<option value="diet">Diet</option>
<option value="occupation">Occupation</option>
<option value="fathers_name">Fathers Name</option>
<option value="mothers_name">Mothers Name</option>
<option value="mobile_no">Mobile No</option>
<option value="family_values">Family Values</option>
</select>
</div>
</div>
</div>

<div class="row">

<div class="col-md-3">
<div class="form-group">
<label>Annual Income</label>
<input type="number" name="txtStartIncome" placeholder="Start Range" class="form-control">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Annual Income</label>
<input type="number" name="txtEndIncome" placeholder="End Range" class="form-control">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Photo</label>
<select class="form-control" name="optPhoto">
	<option></option>
	<option>With Photo</option>
	<option>Without Photo</option>
</select>
</div>
</div>

<div class="col-md-3">
<label>&nbsp;</label>
<button type="submit" class="btn btn-info btn-block">Search</button>
</div>

</div>

</form>
</div>

</div>
<p><!-- /.collapse --></p>
</div>
</div>

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">All Users ({{$profileCount}})</h3>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>SrNo</th>
<th>Name</th>
<th>Mobile No</th>
<th>Email</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($profileList as $pl)
<tr>
<td>{{$i}}</td>
<td>{{$pl->full_name}}</td>
<td>{{$pl->mobile_no}}</td>
<td>{{$pl->Emails->email}}</td>
<td>
  <a href="#"><i class="fa fa-trash fa-lg" style="color:orange;"></i></a>
  <a href="#"><i class="fa fa-edit fa-lg" style="color:green;"></i></a>
</td>
</tr>
<?php $i++; ?>
@endforeach
</tbody>
<tfoot>
<tr>
<th>SrNo</th>
<th>Name</th>
<th>Mobile No</th>
<th>Email</th>
<th>Action</th>
</tr>
</tfoot>
</table>
</div>


</div><!-- /.box-body -->


</div><!-- /.box -->

<!-- jQuery 2.1.4 -->
<script src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<!-- <script src="{{asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script> -->
<!-- DataTables -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

</section>
@endsection