<header class="main-header">
<!-- Logo -->
<a href="{{route('showDashboard')}}" class="logo">
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini">MM</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg">{{ config('app.name', 'Hishab-Accounting') }}</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">Toggle navigation</span>
</a>
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">

<li>
<a href="{{route('showDashboard')}}">
<i class="fa fa-reply"></i> <span>Go Website</span>
</a>
</li>

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
<i class="fa fa-user fa-fw"></i>
<span class="hidden-xs">{{Auth::user()->role->name}}</span>
</a>
<ul class="dropdown-menu">
<!-- User image -->
<li class="user-header">
<!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
<i class="fa fa-user fa-fw" style="color:white;font-size: 100px;"></i>
<p>
{{Auth::user()->name}} - {{Auth::user()->role->name}}
@if(Auth::user()->created_at!=NULL)
<small>Member since {{Auth::user()->created_at->diffForHumans()}}</small>
@else
<small>Member since Now</small>
@endif
</p>
</li>

<!-- Menu Footer-->
<li class="user-footer">
<div class="pull-left">
<a href="{{route('client.showPersonalInformation')}}" class="btn btn-default btn-flat">Profile</a>
</div>
<div class="pull-right">
<a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
</div>
</li>
</ul>
</li>

</ul>
</div>
</nav>
</header>