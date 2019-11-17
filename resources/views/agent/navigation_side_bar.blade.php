<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
<li class="active treeview">
<a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

<li>
<a href="{{route('agent.agentChangePassword')}}">
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
<li><a href="{{(route('agent.showPackagesByAgent'))}}"><i class="fa fa-circle-o"></i> Client Packages</a></li>
</ul>
</li>


<li class="treeview">
<a href="#">
<i class="fa fa-users"></i>
<span>Users</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{(route('agent.showAgentPaidUsers'))}}"><i class="fa fa-circle-o"></i> Paid Users</a></li>
<li><a href="{{route('agent.showAgentUnpaidUsers')}}"><i class="fa fa-circle-o"></i> Unpaid Users</a></li>
<li><a href="{{route('agent.showAgentUncompleteUsers')}}"><i class="fa fa-circle-o"></i> Incomplete Users</a></li>
<li><a href="{{route('agent.showAgentPublishedUsers')}}"><i class="fa fa-circle-o"></i> Users publish</a></li>
<li><a href="{{route('agent.showAgentUnpublishedUsers')}}"><i class="fa fa-circle-o"></i> Users unpublish</a></li>

<li><a href="{{route('agent.showExpiryUsers')}}"><i class="fa fa-circle-o"></i> Expire Users</a></li>

<li><a href="{{route('agent.showAgentAllUsers')}}"><i class="fa fa-circle-o"></i> All users</a></li>
</ul>
</li>


<li>
<a href="{{route('agent.showReceivePaymentForAgent')}}">
<i class="fa fa-credit-card"></i> <span>Receive Payment</span>
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
