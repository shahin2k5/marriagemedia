@extends('admin.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.showMessage')}}"><i class="fa fa-envelope"></i> Message</a></li>
<li class="active">All Messages</li>
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
<h3 class="box-title">All Messages</h3>
<span class="pull-right">
<a href="{{route('admin.showMessage')}}" class="btn btn-success btn-sm">
  <i class="fa fa-refresh fa-fw"></i>
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
<th>Description</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($all_message as $al)
<tr>
<td>{{$i}}</td>
<td>{{$al->Profile->full_name}}</td>
<td>{{$al->Profile->mobile_no}}</td>
<td>{{$al->description}}</td>
<td>
  <a href="{{route('admin.showReplyMessage', $al->id)}}" class="btn btn-success btn-sm"><i class="fa fa-reply fa-lg"></i> Reply</a>
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
<th>Description</th>
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