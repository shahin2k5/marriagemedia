@extends('admin.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li>All Users</li>
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
<h3 class="box-title">All Clients ({{$profileCount}})</h3>
<span class="pull-right">

<a href="{{route('admin.showAllUsers')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>

<a href="{{route('admin.showNewProfile')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Add New Client">
  <i class="fa fa-plus fa-fw"></i></a>

</span>

</div><!-- /.box-header -->

<div class="container-fluid">
  <div class="well" style="font-size:12px;">
    

    <form action="{{route('admin.allsearch')}}" method="post">
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

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>SrNo</th>
<th>Photo</th>
<th>Name</th>
<th>Mobile No</th>
<th>Email</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($profileList as $pl)
<tr>
<td>{{$i}}</td>
<td>
@if($pl->photo!="")
  <img src="{{asset('./profile/'.$pl->photo)}}" width="100%" />
@else
  @if($pl->sex=="Male")
    <img src="{{asset('./image/man.jpg')}}" width="100%" />
  @else
   <img src="{{asset('./image/woman.jpg')}}" width="100%" />
  @endif
@endif
</td>
<td>{{$pl->full_name}}</td>
<td>{{$pl->mobile_no}}</td>
<td>{{$pl->Emails->email}}</td>
<td>
@if($pl->Emails->active==1)
<a href="{{route('admin.changeActiveStatus', $pl->id)}}" class="btn btn-warning btn-sm">Deactive</a>
@else
<a href="{{route('admin.changeActiveStatus', $pl->id)}}" class="btn btn-success btn-sm">Active</a>
@endif
</td>
<td>
  <!-- <a href="{{route('admin.showPersonalInfoForAdmin', $pl->id)}}"><i class="fa fa-edit fa-lg" style="color:green;"></i></a> || 
  <a href="{{route('admin.deleteProfile', $pl->id)}}"><i class="fa fa-trash fa-lg" style="color:orange;"></i></a> -->
  <a href="{{route('admin.showAllUsersViewById', $pl->id)}}" class="btn btn-primary btn-sm">Details</a>
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