<?php 
	$preference = \App\Model\Preferences::where('client_id', Auth::user()->id)->first();
	// dd($name);
?>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">

<li class="active treeview">
<a href="{{route('client.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
</li>


<li>
<a href="{{route('client.viewProfile')}}">
<i class="fa fa-user"></i> <span>Profile</span>
</a>
</li>

<li class="treeview">
<a href="#">
<i class="fa fa-cog"></i>
<span>My Log</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{route('client.showFollowList')}}"><i class="fa fa-circle-o"></i> Follows List</a></li>
<li><a href="{{route('client.showSendProposals')}}"><i class="fa fa-circle-o"></i> Send Proposals</a></li>
<li><a href="{{route('client.showViewers')}}"><i class="fa fa-circle-o"></i> View Profiles</a></li>
</ul>
</li>


<li class="treeview">
<a href="#">
<i class="fa fa-th"></i>
<span>Who Follow Me</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{route('client.showFollowers')}}"><i class="fa fa-circle-o"></i> Followers</a></li>
<li><a href="{{route('client.showViewersList')}}"><i class="fa fa-circle-o"></i> Viewers</a></li>
<li><a href="{{route('client.showProposals')}}"><i class="fa fa-circle-o"></i> Proposals</a></li>
</ul>
</li>


<li class="treeview">
<a href="#">
<i class="fa fa-envelope"></i>
<span>Message</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{route('client.showInbox')}}"><i class="fa fa-circle-o"></i> Inbox</a></li>
<li><a href="{{route('client.showSentMessage')}}"><i class="fa fa-circle-o"></i> Sent</a></li>
</ul>
</li>

<li>
<a href="{{route('client.showAdminMessage')}}">
<i class="fa fa-list"></i> <span>Message To Admin</span>
</a>
</li>


<li>
<a href="{{route('client.showPreference')}}">
<i class="fa fa-briefcase"></i> <span>Partner Preference
@if($preference=="")
<span class="badge bg-red"><i class="fa fa-edit"></i></span>
@endif
</span>
</a>
</li>

<li>
<a href="{{route('client.showPaymentDetails')}}">
<i class="fa fa-credit-card"></i> <span>Payments</span>
</a>
</li>

<li>
<a href="{{route('client.showChangePasword')}}">
<i class="fa fa-lock"></i> <span>Change Password</span>
</a>
</li>

<li>
<a href="{{route('logout')}}">
<i class="fa fa-sign-out"></i> <span>Log Out</span>
</a>
</li>

</ul>
</section>
<!-- /.sidebar -->
</aside>
