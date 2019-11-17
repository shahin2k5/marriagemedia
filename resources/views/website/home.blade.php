@extends('website.app')
@section('css')
<link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{asset('css/w3.css')}}">
<style type="text/css">
.fa-star, .fa-send, .fa-th{
font-size: 20px;
color:#A2D9CE;
cursor: pointer;
}
.description-text{
font-size: 10px;
color:#A2D9CE;
cursor: pointer;
}
.mySlides {display:none;}
.text-size{
  font-size: 12px;
}

.div-registration{ 
    position:absolute;
    z-index:1001;
    margin-top:2%;
    margin-left:7%;
    background:#000;
    padding:20px;
    opacity: 0.5; 
    width:27% !important; 
    margin-left: 10%; 
    border: 3px solid #CCC; 
    padding: 2%
}
</style>
@endsection
@section('content')

<div id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
@include('website.views.carousel')
</div>



<div class="well well-lg" style="background-color: #ef5350; color: #CCC;">
@include('website.views.quick_search')
</div>




<div class="grid_1">
@include('website.views.featured_profiles')
</div>
<!-- End Feature Profiles -->

<!-- Start Success Stories -->

<div class="grid_2">
<div class="container">
<div class="w3-card-4">

@include('website.views.our_success_story')

</div>
</div>
</div>

<div class="bg">
<div class="container"> 
<h3>Guest Messages</h3>
<div class="heart-divider">
<span class="grey-line"></span>
<i class="fa fa-heart pink-heart"></i>
<i class="fa fa-heart grey-heart"></i>
<span class="grey-line"></span>
</div>
<div class="col-sm-6">

@include('website.views.guess_message')

</div>
<div class="col-sm-6">
<div class="bg_left">

@include('website.views.facebook_comment')

</div>
</div>
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



<!-- <div id="fb-root"></div> -->

@endsection
@section('js')

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

@endsection