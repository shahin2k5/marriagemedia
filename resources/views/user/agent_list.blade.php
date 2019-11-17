@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">All Agents</li>
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
<h3 class="box-title">All Agents</h3>
<span class="pull-right">
<a href="{{route('user.showNewAgent')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Add New Agent">
  <i class="fa fa-plus fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>SrNo</th>
<th>Name</th>
<th>Mobile No</th>
<th>Address</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($agentList as $al)
<tr>
<td>{{$i}}</td>
<td>{{$al->full_name}}</td>
<td>{{$al->mobile_no}}</td>
<td>{{$al->address}}</td>
@if($al->status=="Active")
<td><a href="{{route('user.changeAgentStatus', $al->id)}}" class="btn btn-warning btn-sm">Deactive</a></td>
@else
<td><a href="{{route('user.changeAgentStatus', $al->id)}}" class="btn btn-success btn-sm">Active</a></td>
@endif
<td>
  <a href="{{route('user.editAgent', $al->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit fa-lg"></i> Edit</a>
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
<th>Address</th>
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