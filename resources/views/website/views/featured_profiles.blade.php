<div class="container">
<h1>Featured Profiles</h1>
<div class="heart-divider">
<span class="grey-line"></span>
<i class="fa fa-heart pink-heart"></i>
<i class="fa fa-heart grey-heart"></i>
<span class="grey-line"></span>
</div>

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
<div class="col-xs-12 text-size">
<p>{{substr($pl->occupation,0 ,25)}}</p>
<p>Age : {{$pl->age}}</p>
<p>Hght : {{$pl->height}}</p>
<p>Location : {{$pl->city}}</p>
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

<div class="row">
<div class="col-md-12">
  <a href="{{route('showAdvanceSearch')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus-circle"></i> More profiles</a>
</div>
</div>

</div>