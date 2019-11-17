@extends('client.app')
<style type="text/css">
	label{
		font: sans-serif;
		font-size: 12px;
	}
</style>
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>

<!-- Main content -->
<section class="content">


<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Suggestion Profiles</h3>
<span class="pull-right">
 <a href="{{route('client.dashboard')}}" class="btn btn-warning btn-sm"><i class="fa fa-refresh fa-fw"></i></a>
</span>
</div><!-- /.box-header -->

<div class="container-fluid row">
	<div class="col-md-12">
		<div class="well">



		 <form action="{{route('client.suggestionSearch')}}" method="post">
		 	{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-2">
					<label>From Age</label>
					<select name="optFromAge" class="form-control">
						@if($fromAge != "")
							<option>{{$fromAge}}</option>
						@endif
						@for($i=18; $i<=70; $i++)
						<option>{{$i}}</option>
						@endfor
					</select>
				</div>
				<div class="col-md-2">
					<label>To Age</label>
					<select name="optToAge" class="form-control">
						@if($toAge != "")
							<option>{{$toAge}}</option>
						@endif
						@for($i=70; $i>18; $i--)
						<option>{{$i}}</option>
						@endfor
					</select>
				</div>
				<div class="col-md-2">
					<label>Marital Status</label>
					<select name="optMaritalStatus" class="form-control ">
						@if($maritalStatus != "")
							<option>{{$maritalStatus}}</option>
						@endif
					  <option value="">Select</option>
					  <option>Unmarried</option>
					  <option>Married</option>
					  <option>Divorced</option>
					  <option>Widow</option>
					  <option>Separated</option>
					</select>
				</div>
				<div class="col-md-2">
					<label>Religion</label>
					<select name="optReligion" class="form-control">
						@if($religion != "")
							<option>{{$religion}}</option>
						@endif
					  
					  <option value="">Select</option>
					  <option>Anglican</option>
					  <option>Atheist</option>
					  <option>Baptist</option>
					  <option>Buddhist/Taoist</option>
					  <option>Christian(Catholic)</option>
					  <option>Christian(Other)</option>
					  <option>Christian(Protestant)</option>
					  <option>Evengelical</option>
					  <option>Hindu</option>
					  <option>Jain</option>
					  <option>Jewish</option>
					  <option>Methodist</option>
					  <option>Mormon/Lds</option>
					  <option>Muslim</option>
					  <option>Pagan/Earth- Based</option>
					  <option>Scientology</option>
					  <option>Sikh</option>
					  <option>Spiritual But Not Religious</option>
					  <option>Not Religious</option>
					  <option>Other</option>
					</select>
				</div>
				<div class="col-md-2">
					<label>Photo</label>
					<select name="optPhoto" class="form-control">
						@if($photo != "")
							<option>{{$photo}}</option>
						@endif
					  <option>All</option>
					  <option>With Photo</option>
					  <option>Without Photo</option>
					</select>
				</div>
				<div class="col-md-2">
					<label>&nbsp;</label>
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
				</div>
			</div>
		  </form>



		</div>
	</div>
</div>

<div class="box-body">


@if($profileInfo->sex=="Male")
<div class="table-responsive">
	<table id="example1" class="table table-bordered table-striped">
		<thead style="font-size:14px;">
			<tr>
				<th width="15%">Photo</th>
				<th width="10%">Age</th>
				<th width="15%">Gender</th>
				<th width="20%">Occupation</th>
				<th width="15%">Marital Status</th>
				<th width="15%">Religion</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody style="font-size:12px;">
	@if($femaleProfiles)
		@foreach($femaleProfiles as $fp)
			<tr>
				<td style="vertical-align: middle;text-align: center;">
				@if($fp->photo!="")
					<img src="{{asset('./profile/'.$fp->photo)}}" width="100%" />
				@else
					<img src="{{asset('./image/woman.jpg')}}" width="100%" />
				@endif
				</td>
				<td style="vertical-align: middle;text-align: center;">{{ $fp->age }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $fp->sex }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $fp->occupation }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $fp->marital_status }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $fp->religion }}</td>
				<td style="vertical-align: middle;text-align: center;"><a href="{{route('client.showSuggestionProfile', $fp->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-fw"></i></a></td>
			</tr>
		@endforeach
	@endif
		</tbody>
	</table>	
</div>
@elseif($profileInfo->sex=="Female")
<div class="table-responsive">
	<table id="example1" class="table table-bordered table-striped">
		<thead style="font-size:14px;">
			<tr>
				<th width="20%">Photo</th>
				<th width="10%">Age</th>
				<th width="20%">Gender</th>
				<th width="20%">Occupation</th>
				<th width="20%">Marital Status</th>
				<th width="15%">Religion</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody style="font-size:12px;">
	@if($maleProfiles)
		@foreach($maleProfiles as $mp)
			<tr>
				<td style="vertical-align: middle;text-align: center;">
				@if($mp->photo!="")
					<img src="{{asset('./profile/'.$mp->photo)}}" width="100%" />
				@else
					<img src="{{asset('./image/man.jpg')}}" width="100%" />
				@endif
				</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->age }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->sex }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->occupation }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->marital_status }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->religion }}</td>
				<td style="vertical-align: middle;text-align: center;"><a href="{{route('client.showSuggestionProfile', $mp->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-fw"></i></a></td>
			</tr>
		@endforeach
	@endif
		</tbody>
	</table>	
</div>
@else
<div class="table-responsive">
	<table id="example1" class="table table-bordered table-striped">
		<thead style="font-size:14px;">
			<tr>
				<th width="20%">Photo</th>
				<th width="10%">Age</th>
				<th width="20%">Gender</th>
				<th width="20%">Occupation</th>
				<th width="20%">Marital Status</th>
				<th width="15%">Religion</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody style="font-size:12px;">
		@foreach($maleProfiles as $mp)
			<tr>
				<td style="vertical-align: middle;text-align: center;">
				@if($mp->photo!="")
					<img src="{{asset('./profile/'.$mp->photo)}}" width="100%" />
				@else
					<img src="{{asset('./image/man.jpg')}}" width="100%" />
				@endif
				</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->age }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->sex }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->occupation }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->marital_status }}</td>
				<td style="vertical-align: middle;text-align: center;">{{ $mp->religion }}</td>
				<td style="vertical-align: middle;text-align: center;"><a href="{{route('client.showSuggestionProfile', $mp->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-fw"></i></a></td>
			</tr>
		@endforeach
		</tbody>
	</table>	
</div>
@endif

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

</section><!-- /.content -->


@endsection
