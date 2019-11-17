@extends('client.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-envelope"></i> Message</a></li>
<li class="active">Inbox</li>
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
<h3 class="box-title">Inbox ({{$inboxCount}})</h3>
<span class="pull-right">
<a href="{{route('client.showInbox')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Refresh">
  <i class="fa fa-refresh fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th width="20%">Sender</th>
<th width="30%">Message</th>
<th width="20%">Date</th>
<th width="30%" colspan="2">Action</th>
</tr>
</thead>
<tbody>
@foreach($inboxList as $il)
<tr>
<td>{{$il->SenderProfile->full_name}}</td>
<td>{{$il->description}}</td>
<td>{{Date('jS M Y', strtotime($il->created_at))}}</td>
<td>
  <a href="{{route('client.showIndexProfile', $il->SenderProfile->id)}}" class="btn btn-success btn-sm">View Profile</a>
 </td>
  <td> <a href="{{route('client.showMessageList', $il->id)}}" class="btn btn-primary btn-sm">View Message</a>
</td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
<th width="20%">Sender</th>
<th width="30%">Message</th>
<th width="20%">Date</th>
<th width="30%" colspan="2">Action</th>
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