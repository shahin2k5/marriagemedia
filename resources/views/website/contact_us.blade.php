@extends('website.app')
@section('content')

<div class="grid_1">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="{{route('showDashboard')}}"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Contact</li>
</ul>
</div>

</div>
</div>

<div class="container">
<div class="row">

<div class="col-md-6">
<div class="box box-widget" style="margin-bottom: 0;">
<form>
<div class="box-header with-border">
Contact Us
</div>	
<div class="box-body">


<div class="form-group">
<input type="text" name="txtName" id="txtName" class="form-control input-sm" placeholder="Name" autofocus="autofocus" />
</div>

<div class="form-group">
<input type="text" name="txtSubject" id="txtSubject" class="form-control input-sm" placeholder="Subject" />
</div>

<div class="form-group">
<input type="text" name="txtEmail" id="txtEmail" class="form-control input-sm" placeholder="Email ID" />
</div>

<div class="form-group">
<textarea name="txtDescription" class="form-control input-sm" placeholder="Description"></textarea>
</div>

<div class="form-group">
<input type="submit" class="btn btn-primary btn-sm" value = "Send" />
</div>

</div>
</form>
</div>
</div>

<div class="col-md-6">
<div class="box box-widget" style="margin-bottom: 0; margin-top: 1%;">

<div class="box-header with-border">
Address
</div>	
<div class="box-body">
<address>
Company Name : {{$companyInfo->company_name or ''}} <br>
Address 	 : {{$companyInfo->address or ''}} <br>
Email ID 	 : {{$companyInfo->email or ''}} <br>
Mobile No 	 : {{$companyInfo->mobile_no}}
</address>
</div>
</div>
</div>

</div>

<div>
<script type="text/javascript">
	function add_chatinline(){
		var hccid=48737257;
		var nt=document.createElement("script");
		nt.async=true;
		nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;
		var ct=document.getElementsByTagName("script")[0];
		ct.parentNode.insertBefore(nt,ct);
	}
	add_chatinline(); 
</script>
</div>

</div>

<!-- <div style="overflow:hidden;width: 950px;position: relative;"><iframe width="950" height="440" src="https://maps.google.com/maps?width=950&amp;height=440&amp;hl=en&amp;q=Jatrabari%20Dhaka%2C%20Bangladesh+(My%20Project)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div style="position: absolute;width: 80%;bottom: 20px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br /> -->
@endsection