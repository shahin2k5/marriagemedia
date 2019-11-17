<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>{{ config('app.name', 'Hishab-Accounting') }}</title>

<!-- Bootstrap Core CSS -->
<link href="{{asset('theme/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="{{asset('theme/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{asset('theme/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


</head>

<body>

<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">Hishab-Accounting</h3>
</div>
<div class="panel-body">
<form role="form" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
<fieldset>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<input class="form-control" placeholder="E-mail" name="email" id="email" type="email" value="{{ old('email') }}" required="required" autofocus  autocomplete="off" />
@if ($errors->has('email'))
<span class="help-block">
<strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<input class="form-control" placeholder="Password" name="password" id="password" type="password" required autocomplete="off" />
@if ($errors->has('password'))
<span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>
<div class="checkbox">
<label>
<input name="remember" type="checkbox" value="Remember Me" {{ old('remember') ? 'checked' : '' }}>Remember Me
</label>
</div>
<!-- Change this to a button or input when using this as a form -->
<button type="submit" class="btn btn-success btn-block">Login</button>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>

<!-- jQuery -->
<script src="{{asset('theme/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('theme/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('theme/metisMenu/metisMenu.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('dist/js/sb-admin-2.js')}}"></script>

</body>

</html>
