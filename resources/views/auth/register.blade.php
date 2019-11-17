@extends('website.app')
@section('content')

<div class="grid_3">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="{{route('showDashboard')}}"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Register</li>
</ul>
</div>

<div class="row">
<div class="col-sm-6">
@if(Session::has('error'))
<div class="alert alert-danger fade in">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Warning!</strong> {{Session::get('error')}}
</div>
@endif
</div>
</div>

<div class="services">
<div class="col-sm-6 login_left">
<form action="{{route('createRegister')}}" method="post">
	{!! csrf_field() !!}
<div class="form-group">
<label for="txtUsername">Username <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="txtUsername" name="txtUsername" value="" size="60" maxlength="60" class="form-text required" autofocus="autofocus" required="required">
</div>
<div class="form-group">
<label for="txtPassword">Password <span class="form-required" title="This field is required.">*</span></label>
<input type="password" id="txtPassword" name="txtPassword" size="60" maxlength="128" class="form-text required" required="required">
</div>
<div class="form-group">
<label for="txtEmail">Email <span class="form-required" title="This field is required.">*</span></label>
<input type="email" id="txtEmail" name="txtEmail" value="" size="60" maxlength="60" class="form-text required" required="required">
</div>
<div class="age_select">
<label for="txtAge">Age <span class="form-required" title="This field is required.">*</span></label>
<input type="date" id="txtAge" name="txtAge" class="form-control" />
</div>
<div class="form-group form-group1">
<label class="col-sm-7 control-lable" for="rdSex">Gender : </label>
<div class="col-sm-5">
<div class="radios">
<label for="radio-01" class="label_radio">
<input type="radio" checked="" name="rdSex" value="Male"> Male
</label>
<label for="radio-02" class="label_radio">
<input type="radio" name="rdSex" value="Female"> Female
</label>
</div>
</div>
<div class="clearfix"> </div>
</div>
<div class="form-actions">
<input type="submit" id="edit-submit" name="op" value="Submit" class="btn_1 submit">
</div>
</form>
</div>
<div class="col-sm-6">
<ul class="sharing">
<li><a href="#" class="facebook" title="Facebook"><i class="fa fa-boxed fa-fw fa-facebook"></i> Share on Facebook</a></li>
<li><a href="#" class="twitter" title="Twitter"><i class="fa fa-boxed fa-fw fa-twitter"></i> Tweet</a></li>
<li><a href="#" class="google" title="Google"><i class="fa fa-boxed fa-fw fa-google-plus"></i> Share on Google+</a></li>
<li><a href="#" class="linkedin" title="Linkedin"><i class="fa fa-boxed fa-fw fa-linkedin"></i> Share on LinkedIn</a></li>
<li><a href="#" class="mail" title="Email"><i class="fa fa-boxed fa-fw fa-envelope-o"></i> E-mail</a></li>
</ul>
</div>
<div class="clearfix"> </div>
</div>
</div>
</div>
@endsection
