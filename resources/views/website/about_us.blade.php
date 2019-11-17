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
</div>
</div>

<div class="about_bottom">
<div class="container">
<h3>Team Members</h3>

@foreach($teamMembers as $tm)
<div class="col-md-3 about_grid1">
<ul class="posts-grid our-team">
<li class="list-item-1">
<figure class="thumbnail_1 thumbnail">
<img src="{{asset('./teamphoto/'.$tm->photo)}}"  class="img-responsive" alt="" style="width: 100%;"/>
<!-- <div class="post_networks">
<ul>
<li class="network_0"><a href="#" title=""><i class="fa fa-facebook"></i></a></li>
</ul>
</div> -->
</figure>
<div class="desc" style="text-align: center;">
<h4>{{$tm->full_name or ''}}</h4>
<p>{{$tm->designation or ''}}</p>
</div>
</li>
</ul>
</div>
@endforeach

<div class="clearfix"> </div>
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

@endsection