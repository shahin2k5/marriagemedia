@extends('client.app')

@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Payments</li>
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
<h3 class="box-title">Payments</h3>
<span class="pull-right">
<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Send Payment</a>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<form action="{{route('client.insertPaymentDetails')}}" method="post">
  {!! csrf_field() !!}
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h4 class="modal-title" id="myModalLabel">
Send Payment
</h4>
</div>

<div class="modal-body">

<div class="form-group">
<label>Packages</label>
<select class="form-control" name="optPackages" id="optPackages" required>
  <option value="">SELECT</option>
  @foreach($packages as $package)
  <option value="{{$package->id}}">{{$package->name}}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<label>Payment Method</label>
<select class="form-control" name="optPaymentMethod" id="optPaymentMethod" required>
  <option value="">SELECT</option>
  <option>Cash</option>
  <option>Mobile</option>
</select>
</div>

<div class="form-group">
<label>Mobile No</label>
<input type="number" name="txtMobileNo" id="txtMobileNo" class="form-control" disabled />
</div>

<div class="form-group">
<label>Transaction ID</label>
<input type="number" name="txtTransId" id="txtTransId" class="form-control" disabled />
</div>

<div class="form-group">
<label>Amount</label>
<input type="number" name="txtAmount" id="txtAmount" class="form-control" readonly="readonly" />
</div>

</div><!-- End modal-body -->

<div class="modal-footer">
  <button type="submit" class="btn btn-primary">
Send
</button>
<button type="button" class="btn btn-danger"
data-dismiss="modal">Close
</button>
</div>
</div>
</div><!-- /.modal-content -->
</form>
</div><!-- /.modal -->


<a href="{{route('client.showPaymentDetails')}}" class="btn btn-success btn-sm" data-toggle = "title" title = "Refresh">
  <i class="fa fa-refresh fa-fw"></i>
</a>
</span>
</div><!-- /.box-header -->

<div class="box-body">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>Package</th>
<th>Method</th>
<th>Mobile No</th>
<th>Trans. ID</th>
<th>Amount</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
@foreach($paymentsInfo as $pi)
<tr>
<td>{{$pi->PackageInfo->name}}</td>
<td>{{$pi->payment_method}}</td>
<td>{{$pi->mobile_no}}</td>
<td>{{$pi->trans_id}}</td>
<td>{{$pi->amount}}</td>
<td>
@if($pi->verified_by==NULL)
<small class="label label-danger">Pending</small>
@else
<small class="label label-success">Approved</small>
@endif
</td>
</tr>
<?php $i++; ?>
@endforeach
</tbody>
<tfoot>
<tr>
<th>Package</th>
<th>Method</th>
<th>Trans. ID</th>
<th>Amount</th>
<th>Status</th>
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


    $('#optPaymentMethod').on('change', function(e){
      e.preventDefault();
      if($(this).val()=="Cash"){
        $('#txtMobileNo').attr('disabled', true);
        $('#txtTransId').attr('disabled', true);
      }else{
        $('#txtMobileNo').attr('disabled', false);
        $('#txtTransId').attr('disabled', false);
      }
    });

    $('#optPackages').on('click', function(e){
      e.preventDefault();
      var package_id = $(this).val();
      $.ajax({
        url:"{{route('client.clientPackageSelectByID')}}",
        method:"GET",
        dataType:"json",
        data:{package_id:package_id},
        success:function(data){
          console.log(data);
          $("#txtAmount").val(data.packageInfo.price);
          // alert(data.packageInfo.price);
        },
        error:function(data){
          console.log(data);
        }
      });
    });

    
  });
</script>

</section>
@endsection