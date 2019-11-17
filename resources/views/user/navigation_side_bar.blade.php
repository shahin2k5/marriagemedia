<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
<li class="active treeview">
<a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

<li class="treeview">
<a href="#">
<i class="fa fa-cog"></i>
<span>Site Options</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<li>
<a href="{{route('user.showCompanyInfo')}}">
<i class="fa fa-bolt"></i> <span>Company Info</span>
</a>
</li>

<li>
<a href="{{route('user.showSliderImage')}}">
<i class="fa fa-bookmark"></i> <span>Slider</span>
</a>
</li>

<li>
<a href="{{route('user.showTeamMember')}}">
<i class="fa fa-users"></i> <span>Team Member</span>
</a>
</li>

</ul>
</li>



<li>
<a href="{{route('user.showChangePaswordForm')}}">
<i class="fa fa-lock"></i> <span>Change Password</span>
</a>
</li>

<li class="treeview">
<a href="#">
<i class="fa fa-briefcase"></i>
<span>Packages</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showClientPackages'))}}"><i class="fa fa-circle-o"></i> Client Packages</a></li>
<li><a href="{{route('user.showAgentPackages')}}"><i class="fa fa-circle-o"></i> Agent Packages</a></li>
</ul>
</li>

<li class="treeview">
<a href="#">
<i class="fa fa-graduation-cap"></i>
<span>Clients</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showPaidUsers'))}}"><i class="fa fa-circle-o"></i> Paid Clients</a></li>
<li><a href="{{route('user.showUnpaidUsers')}}"><i class="fa fa-circle-o"></i> Unpaid Clients</a></li>
<li><a href="{{route('user.showUncompleteUsers')}}"><i class="fa fa-circle-o"></i> Incomplete Clients</a></li>
<li><a href="{{route('user.showPublishedUsers')}}"><i class="fa fa-circle-o"></i> Published Clients</a></li>
<li><a href="{{route('user.showUnpublishedUsers')}}"><i class="fa fa-circle-o"></i> Unpublished Clients</a></li>
<li><a href="{{route('user.showAllUsers')}}"><i class="fa fa-circle-o"></i> All Clients</a></li>
</ul>
</li>



<li class="treeview">
<a href="#">
<i class="fa fa-list"></i>
<span>Agents</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showAgentList'))}}"><i class="fa fa-circle-o"></i> All Agents</a></li>
<li><a href="{{(route('user.showNewAgent'))}}"><i class="fa fa-circle-o"></i> New Agents</a></li>
<li><a href="{{(route('user.showUnpaidAgent'))}}"><i class="fa fa-circle-o"></i> Unpaid Agents</a></li>
<li><a href="{{(route('user.showPaidAgent'))}}"><i class="fa fa-circle-o"></i> Paid Agents</a></li>
<li><a href="{{(route('user.showAgentExpInfo'))}}"><i class="fa fa-circle-o"></i> Agent Expire Info</a></li>
</ul>
</li>


<li>
<a href="{{route('user.showReceivePayment')}}">
<i class="fa fa-credit-card"></i> <span>Receive Payment</span>
</a>
</li>


<li class="treeview">
<a href="#">
<i class="fa fa-paperclip"></i>
<span>Posts</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showAllPosts'))}}"><i class="fa fa-circle-o"></i> All Posts</a></li>
<li><a href="{{route('user.showNewPost')}}"><i class="fa fa-circle-o"></i> New Post</a></li>
</ul>
</li>


<li class="treeview">
<a href="#">
<i class="fa fa-link"></i>
<span>Links</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showAllLinks'))}}"><i class="fa fa-circle-o"></i> All Links</a></li>
<li><a href="{{route('user.showNewLinks')}}"><i class="fa fa-circle-o"></i> New Links</a></li>
</ul>
</li>


<!-- <li class="treeview">
<a href="#">
<i class="fa fa-users"></i>
<span>Users</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('user.showAllNormalUsers'))}}"><i class="fa fa-circle-o"></i> All Users</a></li>
<li><a href="{{route('user.showNewUser')}}"><i class="fa fa-circle-o"></i> New User</a></li>
</ul>
</li> -->


<li><a href="{{route('logout')}}">
	<i class="fa fa-sign-out"></i> <span>Log Out</span>
</a></li>

</ul>
</section>
<!-- /.sidebar -->
</aside>
