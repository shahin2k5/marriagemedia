@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">All Links</li>
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
<h3 class="box-title">All Links</h3>
<span class="pull-right">
<a href="{{route('user.showNewLinks')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Add New Links">
  <i class="fa fa-plus fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr width = "100%">
<th width = "20%">Image</th>
<th width = "20%">Icon</th>
<th width = "10%">Title</th>
<th width = "40%">Link</th>
<th width = "10%">Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($allLinks as $al)
<tr>
<td><img src="{{asset('linkimages/'.$al->image_icon)}}" width="100%" /></td>
<td style="vertical-align: middle;"><i class="{{$al->design_icon}}"></i> - {{$al->design_icon}}</td>
<td style="vertical-align: middle;">{{$al->title}}</td>
<td style="vertical-align: middle;">{{$al->url}}</td>
<td style="vertical-align: middle;">
  <a href="{{route('user.deleteLink', $al->id)}}"><i class="fa fa-trash fa-lg" style="color:orange;"></i></a>
  <a href="{{route('user.editLinks', $al->id)}}"><i class="fa fa-edit fa-lg" style="color:green;"></i></a>
</td>
</tr>
<?php $i++; ?>
@endforeach
</tbody>
<tfoot>
<tr>
<th>Image</th>
<th>Icon</th>
<th>Title</th>
<th>Link</th>
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