@extends('client.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-envelope"></i> Message</a></li>
<li class="active">Sent</li>
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
<h3 class="box-title">Sent List</h3>
<span class="pull-right">
<a href="{{route('client.showFollowList')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Refresh">
  <i class="fa fa-refresh fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr width = "100%">
	<th width = "20%">Profile Name</th>
	<th width = "20%">Subject</th>
	<th width = "30%">Description</th>
	<th width = "10%">Status</th>
	<th width = "20%">Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($sentMessage as $sm)
<tr>
	<td style="vertical-align: middle;">{{$sm->ReceiverProfile->full_name}}</td>
	<td>{{$sm->title}}</td>
	<td style="vertical-align: middle;">{{$sm->description}}</td>
	<td style="vertical-align: middle;">{{$sm->status}}</td>
	<td style="vertical-align: middle;">
	  <a href="{{route('client.showSentProfile', $sm->ReceiverProfile->id)}}" class="btn btn-success btn-sm">View Profile</a>
	 </td>
	<td style="vertical-align: middle;"> <a href="{{route('client.showSentMessageList', $sm->id)}}" class="btn btn-primary btn-sm">View Message</a>
	</td>
</tr>
<?php $i++; ?>
@endforeach
</tbody>
<tfoot>
<tr>
	<th>Profile Name</th>
	<th>Subject</th>
	<th>Description</th>
	<th>Status</th>
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