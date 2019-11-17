@extends('client.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">All Proposals</li>
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
<h3 class="box-title">All Proposals ({{$proposalsCounts}})</h3>
<span class="pull-right">
<a href="{{route('client.showProposals')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Refresh">
  <i class="fa fa-refresh fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>Profile Id</th>
<th>Image</th>
<th>Education</th>
<th>Age</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($proposals as $pl)
<tr>
<td style="vertical-align: middle;">{{$pl->Profile->id or ''}}</td>
<td><img src="{{asset('profile/'.$pl->Profile->photo)}}" width="50%" /></td>
<td style="vertical-align: middle;">{{$pl->Profile->education or ''}}</td>
<td style="vertical-align: middle;">{{$pl->Profile->age or ''}}</td>
<td style="vertical-align: middle;">
  <a href="{{route('client.showProposalsView', $pl->profile_id)}}"><i class="fa fa-eye fa-lg" style="color:green;"></i></a>
</td>
</tr>
<?php $i++; ?>
@endforeach
</tbody>
<tfoot>
<tr>
<th>Profile Id</th>
<th>Image</th>
<th>Education</th>
<th>Age</th>
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