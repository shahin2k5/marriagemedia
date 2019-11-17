<div class="navbar navbar-inverse-blue navbar">
<div style="width:100%;background:#e20202;color: white;text-align: right;padding:0.5% 5%;font-size:12px;font-weight: bold;">
<span>
	Hotline: 01992706900. <i class="fa fa-support"> </i> Live Chat
</span>
</div>
<!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
<div class="navbar-inner">
<div class="container">

<a class="brand" href="{{route('showDashboard')}}">
	<img src="{{asset('image/'.$companyInfo->logo)}}" alt="{{$companyInfo->company_name or 'Marriage Media'}}" data-toggle = "title" title = "{{$companyInfo->company_name or 'Marriage Media'}}" style="border-radius:50%; width:10%;" />
</a>

<div class="pull-right">
<nav class="navbar nav_bottom" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header nav_2">
<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">Menu
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#"></a>
</div> 
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
<ul class="nav navbar-nav nav_1">
<li><a href="{{route('showDashboard')}}" style="font-size: 12px;"><i class="fa fa-home"></i><br/>Home</a></li>
<li><a href="{{route('showAboutUs')}}" style="font-size: 12px;"><i class="fa fa-users"></i><br/>About</a></li>
<li><a href="{{route('showAdvanceSearch')}}" style="font-size: 12px;"><i class="fa fa-search"></i><br/>Advance Search</a></li>
<li><a href="{{route('showAgentMenu')}}" style="font-size: 12px;"><i class="fa fa-briefcase"></i><br/>Agent</a></li>
<li><a href="{{route('showPaymentMethod')}}" style="font-size: 12px;"><i class="fa fa-credit-card"></i><br/>Payment Method</a></li>

@if(Auth::check() && Auth::user()->role->id==1)
<li class="last"><a href="{{route('admin.dashboard')}}" style="font-size: 12px;"><i class="fa fa-dashboard"></i><br/>My Dashboard</a></li>
@elseif(Auth::check() && Auth::user()->role->id==2)
<li class="last"><a href="{{route('user.dashboard')}}" style="font-size: 12px;"><i class="fa fa-dashboard"></i><br/>My Dashboard</a></li>
@elseif(Auth::check() && Auth::user()->role->id==3)
<li class="last"><a href="{{route('agent.dashboard')}}" style="font-size: 12px;"><i class="fa fa-dashboard"></i><br/>My Dashboard</a></li>
@elseif(Auth::check() && Auth::user()->role->id==4)
<li class="last"><a href="{{route('client.dashboard')}}" style="font-size: 12px;"><i class="fa fa-dashboard"></i><br/>My Dashboard</a></li>
@else
<li class="last"><a href="{{route('showlogin')}}" style="font-size: 12px;"><i class="fa fa-sign-in"></i><br/>Login / Register</a></li>
@endif

<li class="last"><a href="{{route('showContact')}}" style="font-size: 12px;"><i class="fa fa-book"></i><br/>Contact Us</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div> <!-- end pull-right -->
<div class="clearfix"> </div>
</div> <!-- end container -->
</div> <!-- end navbar-inner -->
</div> <!-- end navbar-inverse-blue -->