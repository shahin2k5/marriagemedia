@extends('user.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Team Member</li>
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

<div class="row">
<div class="col-md-4">

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">New Team Member</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form action="{{route('user.insertTeamMember')}}" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="box-body">
<div class="form-group">
    <label for="txtFullName">Full Name:</label>
    <input type="text" name = "txtFullName"  class="form-control" id="txtFullName" required="required" autofocus="autofocus" />
  </div>
  <div class="form-group">
    <label for="txtDesignation">Designation:</label>
    <input type="text" class="form-control" name="txtDesignation" id="txtDesignation" required="required" />
  </div>
  <div class="form-group">
    <label for="flPhoto">Select Photo:</label>
    <input type="file" class="form-control" name="flPhoto" id="flPhoto" required="required" />
  </div>
</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div><!-- /.box -->

	
</div>


<div class="col-md-8">
	

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Team Member List</h3>
</div><!-- /.box-header -->

<div class="container-fluid">
<table class="table table-bordered table-stripped" id="example1">
	<thead>
		<tr>
			<th width="25%">Photo</th>
			<th width="25%">Name</th>
			<th width="30%">Designation</th>
			<th width="20%">Action</th>
		</tr>
	</thead>

	<tbody>
	@foreach($teamMember as $tm)
		<tr>
			<td><img src="{{asset('./teamphoto/'.$tm->photo)}}" class="img-responsive" /></td>
			<td style="vertical-align: middle;">{{$tm->full_name}}</td>
			<td style="vertical-align: middle;">{{$tm->designation}}</td>
			<td style="vertical-align: middle;">
				<a href="{{route('user.deleteTeamMember', $tm->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>

	<form action="{{route('user.updateTeamMember', $tm->id)}}" method="post" enctype="multipart/form-data">
		{!! csrf_field() !!}
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close"
			data-dismiss="modal" aria-hidden="true">
			&times;
			</button>
			<h4 class="modal-title" id="myModalLabel">
				Edit / Update Team Member
			</h4>
			</div>

			<div class="modal-body">

			<div class="row">

			 <div class="col-md-12">
			  <div class="form-group">
			    <label for="txtFullName">Full Name:</label>
			    <input type="text" name = "UtxtFullName"  class="form-control" id="UtxtFullName" value="{{$tm->full_name or ''}}" required="required" autofocus="autofocus" />
			  </div>
			</div>
			  
			 <div class="col-md-12">
			  <div class="form-group">
			    <label for="txtDesignation">Designation:</label>
			    <input type="text" class="form-control" name="UtxtDesignation" id="UtxtDesignation" value="{{$tm->designation or ''}}" required="required" />
			  </div>
			</div>
			  
			 <div class="col-md-12">
			  <div class="form-group">
			    <label for="flPhoto">Select Photo:</label><br/>
			    <input type="file" class="form-control" name="flUPhoto" id="flUPhoto" style="width: 70%;" />
			  </div>
			</div>

			</div>

			</div><!-- End modal-body -->

			<div class="modal-footer">
			<button type="button" class="btn btn-danger"
			data-dismiss="modal">Close
			</button>
			<button type="submit" class="btn btn-primary">
			Update
			</button>
			</div>
			</div>
			</div><!-- /.modal-content -->
			</div><!-- /.modal -->

		</form>


			</td>
		</tr>
	@endforeach
	</tbody>

	<tfoot>
		<tr>
			<th>Photo</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Action</th>
		</tr>
	</tfoot>
</table>
</div>

</div><!-- /.box -->


</div>

</div>

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