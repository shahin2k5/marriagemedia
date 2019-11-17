<ol class="carousel-indicators">
<?php $i=1; ?>
@foreach($sliders as $sls)
<li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
<?php $i++; ?>
@endforeach
</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" style="border: 5px solid #d32f2f;">
    
    <form action="{{route('showRegistration')}}" method="post">
      {{ csrf_field() }}
    
    <div class="div-registration">
      <div class="row" style="margin-bottom: 2%;opacity: 0.9" >
        <div class="col-md-12">
          @if(Session::has('warning'))
          <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Warning!</strong> {{Session::get('warning')}}            
          </div>
          @endif
        </div>
      </div>
      <h5 style="text-align: center; color:white;">Free Registration</h5>
        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Name</label></div> -->
            <div class="col-md-12">
              <input name="txtFullName" placeholder="Full Name" class="form-control input-sm" type="text" autofocus="autofocus" >
            </div>
        </div>
        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Email</label></div> -->
            <div class="col-md-12">
              <input name="txtEmail" placeholder="Email ID" class="form-control input-sm" type="email" >
            </div>
        </div>
        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Mobile</label></div> -->
            <div class="col-md-12">
              <input name="txtMobileNo" placeholder="Mobile No" class="form-control input-sm" type="number" >
            </div>
        </div>
        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Mobile</label></div> -->
            <div class="col-md-12">
              <select name="optGender" class="form-control input-sm">
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
        </div>
        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Password</label></div> -->
            <div class="col-md-12">
              <input name="txtPassword" placeholder="Password" class="form-control input-sm" type="password" >
            </div>
        </div>

        <div class="row" style="margin-bottom: 5%;">
            <!-- <div class="col-md-4"><label style="color: white;font-size: 12px;" class="pull-right">Password</label></div> -->
            <div class="col-md-12">
              <input name="cpassword" placeholder="Confirm Password" class="form-control input-sm" type="password" >
            </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="text-align: center;">
            <button type="submit" class="btn btn-success btn-sm btn-sm"><i class="glyphicon glyphicon-upload"></i> Sign Up</button>
          </div>
        </div>

    </div>

    </form>

<div class="item active">
<img src="{{asset('slider/'.$welcomeSlide->image)}}" alt="{{$welcomeSlide->title or ''}}" style="width:100%;">
<div class="carousel-caption" style="margin-left: 10%">
<h3>{{$sls->title or 'Millions of verified Members'}}</h3>
<p><a  style="font-size: 13px;" href="{{route('showlogin')}}" class="hvr-shutter-out-horizontal">Create your Profile</a></p>
</div>
</div>
@foreach($sliders as $sls)
<div class="item">
<img src="{{asset('slider/'.$sls->image)}}" alt="{{$sls->title or ''}}" style="width:100%;">
<div class="carousel-caption" style="margin-left: 10%">
<h3>{{$sls->title or 'Millions of verified Members'}}</h3>
<p><a  style="font-size: 13px;" href="{{route('register')}}" class="hvr-shutter-out-horizontal">Create your Profile</a></p>
</div>
</div>
@endforeach

<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
<span class="sr-only">Next</span>
</a>
</div>