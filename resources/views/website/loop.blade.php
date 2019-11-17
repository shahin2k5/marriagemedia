@extends('website.app')
@section('content')
<div class="grid_1">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="index.html"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">{{$aboutPost->title or 'About Us'}}</li>
</ul>
</div>
<div class="about">
<div class="col-md-6 about_left">
@if($aboutPost->images==NULL)
<img src="{{asset('image/a3.jpg')}}" class="img-responsive" alt=""/>
@else
<img src="{{asset('postimages/'.$aboutPost->images)}}" class="img-responsive" alt=""/>
@endif
</div>
<div class="col-md-6 about_right">
<h1>{{$aboutPost->title or 'About Us'}}</h1>
<p>{{$aboutPost->description or 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'}}</p>
</div>
<div class="clearfix"> </div>
</div>
@if($aboutPost->title=="Agent Information")
<div class="row">
 <div class="col-md-12">
  
<div class="container p8">

<div class="resCarousel" data-items="3-4-5-6" data-slide="5" data-speed="900" data-interval="4000" data-load="3" data-animator="lazy">
    <div class="resCarousel-inner" id="eventLoad">
@foreach($agentList as $al)
<a href="{{route('showAgentProfiles', $al->id)}}" target="_blank">
<div class="item">
<div class="tile">
<div style="background: url({{asset('/agentimages/'.$al->icon)}}) center center no-repeat;">
    <h3></h3>
</div>
<h5 style="text-align: left;padding-top:3%;">{{$al->company_name or 'Title'}}</h5>
<p style="margin-top:-5%;text-align: left;"><i class="glyphicon glyphicon-phone"></i>&nbsp;{{$al->mobile_no or 'content'}}</p>
</div>
</div>
</a>
 @endforeach
    </div>
    <button class='btn btn-default leftRs'><</button>
    <button class='btn btn-default rightRs'>></button>
</div>
    </div>
    <!-- End container p8 -->
 </div>
</div>
@endif
</div>
</div>
@endsection