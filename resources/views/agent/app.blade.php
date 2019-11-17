<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Hishab-Accounting') }}</title>


<!-- Bootstrap Core CSS -->
<link href="{{asset('theme/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="{{asset('theme/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<!-- <link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet"> -->

<!-- Morris Charts CSS -->
<link href="{{asset('theme/morrisjs/morris.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{asset('theme/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('adminlte/ionic/css/ionicons.min.css')}}">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">


<link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/flat/blue.css')}}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/morris/morris.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

<!-- Styles -->
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('agent.navigation_top_bar')

@include('agent.navigation_side_bar')

<div class="content-wrapper">

@yield('content')

</div>

@include('agent.footer')
</div>


<!-- jQuery -->
<!-- <script src="{{asset('theme/jquery/jquery.min.js')}}"></script> -->
<script src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

<script src="{{asset('adminlte/js/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('theme/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('theme/metisMenu/metisMenu.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<!-- <script src="{{asset('dist/js/sb-admin-2.js')}}"></script> -->

<!-- Morris.js charts -->
<script src="{{asset('adminlte/js/raphael-min.js')}}"></script>
<script src="{{asset('adminlte/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminlte/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminlte/js/moment.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

<!-- DataTables -->
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false
});
});
</script>

<!-- Scripts -->
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>
