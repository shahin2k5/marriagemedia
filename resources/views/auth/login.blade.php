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
<li class="current-page">Login / Register</li>
</ul>
</div>
<div class="services">

<div class="row">
	<div class="col-md-8 col-md-offset-2" style="border: 1px solid #CCC; padding: 3%; background-color: #EBF5FB;">
		<div class="row">
			<div class="col-md-6" style="background-image: url('./image/login_background_mobile.jpg'); background-repeat: no-repeat; background-size: cover;">
				<div class="well" style="margin: 5%; opacity: 0.6; margin-bottom: 120%; margin-top: 50%;">

					<form role="form" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}
					<div class="form-item form-type-textfield form-item-name">
					<label for="edit-name">Email / Mobile No <span class="form-required" title="This field is required.">*</span></label>
					<input type="text" id="edit-name" name="email" value="" size="60" maxlength="60" class="form-text required">
					</div>
					<div class="form-item form-type-password form-item-pass">
					<label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
					<input type="password" id="edit-pass" name="password" size="60" maxlength="128" class="form-text required" />
					</div>
					<div class="form-actions">
					<a href="{{route('showForgetPassword')}}" style="font-size: 12px;">Forget password</a><br/>
					<input type="submit" id="edit-submit" name="op" value="Log in" class="btn_1 submit">
					</div>
					</form>
								
				</div>
			</div>
			<div class="col-md-6">
				
				<form action="{{route('createRegister')}}" method="post" onsubmit="check_captcha()" autocomplete="off">
	{!! csrf_field() !!}
<div class="form-group">
<label for="txtFullName">Full Name <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="txtFullName" name="txtFullName" value="" size="60" class="form-text required" autofocus="autofocus" required="required">
</div>
<!-- <div class="form-group">
<label for="txtUsername">Username <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="txtUsername" name="txtUsername" value="" size="60" maxlength="60" class="form-text required" required="required">
</div> -->

<div class="form-group">
<label for="txtEmail">Email <span class="form-required" title="This field is required.">*</span></label>
<input type="email" id="txtEmail" name="txtEmail" value="" size="60" class="form-text required" required="required">
</div>

<div class="form-group">
<label for="txtMobileNo">MobileNo <span class="form-required" title="This field is required.">*</span></label>
<input type="number" id="txtMobileNo" name="txtMobileNo" value="" size="60" maxlength="15" class="form-text required" required="required">
</div>

<div class="form-group">
<label for="txtPassword">Password <span class="form-required" title="This field is required.">* (ex: XYZ123456)</span></label>
<input type="password" id="txtPassword" name="txtPassword" size="60" min="8" maxlength="50" class="form-text required" required  pattern="[A-Z]{3}[0-9]{6}" />
<span style="font-size: 10px;color: red;font-weight: bold;">Password must be 3 capital letters with 6 digits of number</span>
</div>

<div class="form-group">
<label for="txtCPassword">Confirm Password <span class="form-required" title="This field is required.">*</span></label>
<input type="password" id="txtCPassword" name="txtCPassword" size="60" min="8" maxlength="50" class="form-text required" required />
</div>

<!-- <div class="age_select">
<label for="dtBirth">Date Of Birth <span class="form-required" title="This field is required.">*</span></label>
<input type="date" id="dtBirth" name="dtBirth" class="form-control" required />
</div> -->

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
</div>
<div class="clearfix"> </div>
<div class="form-group">
<label for="optRole">Register As <span class="form-required" title="This field is required.">*</span></label>
<select id="optRole" name="optRole" class="form-text required" required>
	<option value="">SELECT</option>
	<option value="4">Bride / Groom</option>
	<option value="3">Agent - Match Maker</option>
</select>
<div class="clearfix"> </div>
</div>

<div class="well" style="background: white;">
<label>Captcha</label>
<div class="form-group">
	<?php
		$num1 = rand(1, 10);
		$num2 = rand(1, 10);
	?>
	<input type="hidden" name="txtNum1" id="txtNum1" value="<?php echo $num1; ?>" />
	<input type="hidden" name="txtNum2" id="txtNum2" value="<?php echo $num2; ?>" />
	<span>{{$num1.' + '.$num2.' = '}}<input type="number" name="txtCapthca" id="txtCapthca" size="10"  required /></span>
</div>
</div>

<div class="form-actions">
<input type="submit" id="edit-submit" name="op" value="Register" class="btn_1 submit">
</div>
</form>

			</div>
		</div>
		
	</div>
</div>


<!-- <div class="col-sm-4 login_left">
<div class="well">
<form role="form" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
<div class="form-item form-type-textfield form-item-name">
<label for="edit-name">Email / Username / Mobile No <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="edit-name" name="email" value="" size="60" maxlength="60" class="form-text required">
</div>
<div class="form-item form-type-password form-item-pass">
<label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
<input type="password" id="edit-pass" name="password" size="60" maxlength="128" class="form-text required" />
</div>
<div class="form-actions">
<a href="{{route('showResetPassword')}}" style="font-size: 12px;">Forget password</a><br/>
<input type="submit" id="edit-submit" name="op" value="Log in" class="btn_1 submit">
</div>
</form> 
</div>
</div>-->
<!--
<div class="col-sm-1"></div>

<div class="col-sm-6">
<div class="well">
 <form action="{{route('createRegister')}}" method="post" onsubmit="check_captcha()" autocomplete="off">
	{!! csrf_field() !!}
<div class="form-group">
<label for="txtFullName">Full Name <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="txtFullName" name="txtFullName" value="" size="60" class="form-text required" autofocus="autofocus" required="required">
</div>
<!-- <div class="form-group">
<label for="txtUsername">Username <span class="form-required" title="This field is required.">*</span></label>
<input type="text" id="txtUsername" name="txtUsername" value="" size="60" maxlength="60" class="form-text required" required="required">
</div> -->

<!-- <div class="form-group">
<label for="txtEmail">Email <span class="form-required" title="This field is required.">*</span></label>
<input type="email" id="txtEmail" name="txtEmail" value="" size="60" class="form-text required" required="required">
</div>

<div class="form-group">
<label for="txtMobileNo">MobileNo <span class="form-required" title="This field is required.">*</span></label>
<input type="number" id="txtMobileNo" name="txtMobileNo" value="" size="60" maxlength="15" class="form-text required" required="required">
</div>

<div class="form-group">
<label for="txtPassword">Password <span class="form-required" title="This field is required.">* (ex: XYZ123456)</span></label>
<input type="password" id="txtPassword" name="txtPassword" size="60" min="8" maxlength="50" class="form-text required" required  pattern="[A-Z]{3}[0-9]{6}" />
<span style="font-size: 10px;color: red;font-weight: bold;">Password must be 3 capital letters with 6 digits of number</span>
</div>

<div class="form-group">
<label for="txtCPassword">Confirm Password <span class="form-required" title="This field is required.">*</span></label>
<input type="password" id="txtCPassword" name="txtCPassword" size="60" min="8" maxlength="50" class="form-text required" required />
</div> -->

<!-- <div class="age_select">
<label for="dtBirth">Date Of Birth <span class="form-required" title="This field is required.">*</span></label>
<input type="date" id="dtBirth" name="dtBirth" class="form-control" required />
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
</div>
<div class="clearfix"> </div>
<div class="form-group">
<label for="optRole">Register As <span class="form-required" title="This field is required.">*</span></label>
<select id="optRole" name="optRole" class="form-text required" required>
	<option value="">SELECT</option>
	<option value="4">Bride / Groom</option>
	<option value="3">Agent - Match Maker</option>
</select>
<div class="clearfix"> </div>
</div>

<div class="well" style="background: white;">
<label>Captcha</label>
<div class="form-group">
	<?php
		$num1 = rand(1, 10);
		$num2 = rand(1, 10);
	?>
	<input type="hidden" name="txtNum1" id="txtNum1" value="<?php echo $num1; ?>" />
	<input type="hidden" name="txtNum2" id="txtNum2" value="<?php echo $num2; ?>" />
	<span>{{$num1.' + '.$num2.' = '}}<input type="number" name="txtCapthca" id="txtCapthca" size="10"  required /></span>
</div>
</div>

<div class="form-actions">
<input type="submit" id="edit-submit" name="op" value="Register" class="btn_1 submit">
</div>
</form> 
</div>
</div>-->

<div class="col-sm-1"></div>

<div class="clearfix"> </div>
</div>
</div>
</div>
<script type="text/javascript">
	function check_captcha() {
		var ab = parseInt($("#txtCapthca").val());
		var num1 = parseInt($("#txtNum1").val());	
		var num2 = parseInt($("#txtNum2").val());
		var sums = num1 + num2;
		if(ab!=sums){
			// alert('Wrong captcha entered!');
			$("#txtCapthca").val("");
			$("#txtCapthca").focus();
		}
	}
</script>
@endsection
