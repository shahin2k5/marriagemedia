@extends('website.app')
@section('css')
<link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{asset('css/w3.css')}}">
<style type="text/css">
.fa-star, .fa-send, .fa-th{
font-size: 30px;
color:#A2D9CE;
cursor: pointer;
}
.description-text{
font-size: 10px;
color:#A2D9CE;
cursor: pointer;
}
.mySlides {display:none;}

</style>
@endsection
@section('content')
<div class="grid_1">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="{{route('showDashboard')}}"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Agent Profile</li>
</ul>
</div>
<div class="about">


<div class="row">
<div class="col-md-12">
<img src="{{asset('agentimages/'.$agentList->cover_photo)}}" width="100%" height="350px" />
</div>
<div class="col-md-4">
<img src="{{asset('agentimages/'.$agentList->icon)}}" width="70%" style="border: 1px solid #CCC; margin-top: -20%; margin-left: 10%;" />
</div>
<div class="col-md-8">
<table class="table table-bordered">
 <thead>
 	<tr>
 		<th colspan="3">Agent Information</th>
 	</tr>
 </thead>
 <tbody>
 	<tr>
 		<td>Company Name</td>
 		<td>:</td>
 		<td>{{$agentList->company_name or ''}}</td>
 	</tr>
 	<tr>
 		<td>Address</td>
 		<td>:</td>
 		<td>{{$agentList->address or ''}}</td>
 	</tr>
 	<tr>
 		<td>Mobile No</td>
 		<td>:</td>
 		<td>{{$agentList->mobile_no or ''}}</td>
 	</tr>
 </tbody>
</table>

</div>
</div><!--End Row-->
<div class="clearfix"> </div>

<div class="row" style="cursor: pointer;">
@foreach($profileList as $pl)
<div class="col-md-3">
<div class="box box-widget widget-user w3-hover-shadow">
<!-- Add the bg color to the header using any of the bg-* classes -->
<div class="widget-user-header bg-aqua-active">
<!-- <h4 class="widget-user-username">Alexander Pierce</h4>
<h5 class="widget-user-desc">Founder & CEO</h5> -->
</div>
<div class="widget-user-image">
@if($pl->photo==NULL)
@if($pl->sex=="Male")
<img class="img-circle" src="{{asset('/image/man.jpg')}}" alt="User Avatar">
@else
<img class="img-circle" src="{{asset('/image/woman.jpg')}}" alt="User Avatar">
@endif
@else
<img class="img-circle" src="{{asset('/profile/'.$pl->photo)}}" alt="User Avatar">
@endif
</div>
<div class="box-footer">
<div class="row" style="color: #45B39D;margin:0 auto;">
<div class="col-xs-12">
<p>{{$pl->occupation}}</p>
<p>Age : {{$pl->age}}</p>
<p>Hght : {{$pl->height}}</p>
</div>
</div>
<div class="row">
<div class="col-xs-4 border-right">
<div class="description-block">
<h5 class="description-header">
@if(Auth::check() && Auth::user()->role->id==1)
<i class="fa fa-star"></i>
@elseif(Auth::check() && Auth::user()->role->id==2)
<i class="fa fa-star"></i>
@elseif(Auth::check() && Auth::user()->role->id==3)
<i class="fa fa-star"></i>
@else
<a href="{{route('favoriteSomeone', $pl->id)}}"><i class="fa fa-star"></i></a>
@endif
</h5>
<span class="description-text">FAVORITE</span>
</div><!-- /.description-block -->
</div><!-- /.col -->
<div class="col-xs-4 border-right">
<div class="description-block">
<h5 class="description-header">
@if(Auth::check() && Auth::user()->role->id==1)
<i class="fa fa-send"></i>
@elseif(Auth::check() && Auth::user()->role->id==2)
<i class="fa fa-send"></i>
@elseif(Auth::check() && Auth::user()->role->id==3)
<i class="fa fa-send"></i>
@else
<a href="{{route('sendProposal', $pl->id)}}"><i class="fa fa-send"></i></a>
@endif
</h5>
<span class="description-text">PROPOSAL</span>
</div><!-- /.description-block -->
</div><!-- /.col -->
<div class="col-xs-4">
<div class="description-block">
<h5 class="description-header">
 <a href="{{route('showProfileDetails', $pl->id)}}"><i class="fa fa-th"></i></a> 
</h5>
<span class="description-text">DETAILS</span>
</div><!-- /.description-block -->
</div><!-- /.col -->
</div><!-- /.row -->
</div>
</div><!-- /.widget-user -->
</div>
@endforeach

</div>

<div class="clearfix"> </div>

<div class="row">
	<div class="col-md-12">
		{{$profileList->links()}}
	</div>
</div>

</div>
</div>
</div>
@endsection