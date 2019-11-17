@extends('website.app')
@section('css')
<style type="text/css">
	label{
		font-size: 12px;
		font-family: sans-serif, verdana;
	}
</style>
@endsection
@section('content')
<div class="grid_1">
<div class="container">

<div class="row">
<div class="col-sm-8 col-sm-offset-2">

@if(Session::has('success'))
<div class="alert alert-success fade in">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Success!</strong> {{Session::get('success')}}
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning fade in">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Error!</strong> {{Session::get('warning')}}
</div>
@endif

</div>
</div>

<div class="breadcrumb1">
<ul>
<a href="{{route('showDashboard')}}"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Login / Reset Password </li>
</ul>
</div>

<div class="services">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">Reset Password</div>

<div class="panel-body">
<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<label for="email" class="col-md-4 control-label">E-Mail Address</label>

<div class="col-md-6">
<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

@if ($errors->has('email'))
<span class="help-block">
<strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<label for="password" class="col-md-4 control-label">Password</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password" required>

@if ($errors->has('password'))
<span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
<div class="col-md-6">
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

@if ($errors->has('password_confirmation'))
<span class="help-block">
<strong>{{ $errors->first('password_confirmation') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="btn btn-primary">
Reset Password
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
