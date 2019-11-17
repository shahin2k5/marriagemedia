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
</style>
@endsection
@section('content')
<div class="grid_1">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="{{route('showDashboard')}}"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Advance Search</li>
</ul>
</div>
<div class="about">

<div class="row">
	
	<div class="col-md-3" style="border-right: 1px solid #CCC;">
	
	<form action="" method="post">
		{!! csrf_field() !!}
	
	<div class="row">
	<div class="col-md-12">
	<label>Gender</label><br/>
	<input type="radio" name="btnGender" id="rdFemale" value="Female" fmUri="{{route('showByGender')}}" > Female
	<input type="radio" name="btnGender" id="rdMale" value="Male" fmUri="{{route('showByGender')}}"> Male
	</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>

	<div class="row">
	<div class="col-md-12">
	<label>Age</label><br/>
	<select id="fromAge" fmUri="{{route('showByAge')}}" style="width: 30%; border: 1px solid #CCC">
		<option>18</option>
	@for($i=18; $i<=80; $i++)
		<option>{{$i}}</option>
	@endfor
	</select> To
	<select id="toAge" fmUri="{{route('showByAge')}}" style="width: 30%;border: 1px solid #CCC">
		<option>40</option>
	@for($i=18; $i<=80; $i++)
		<option>{{$i}}</option>
	@endfor
	</select> years
	</div>
	</div>

	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>

	<div class="row">
	<div class="col-md-12">
	<label>Height</label><br/>
	<select id="optFromHeight" style="width: 40%;border: 1px solid #CCC">
		<option></option>
		<option>4ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"4ft ".$i."in"}}</option>
		@endfor
		<option>5ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"5ft ".$i."in"}}</option>
		@endfor
		<option>6ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"6ft ".$i."in"}}</option>
		@endfor
		<option>7ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"7ft ".$i."in"}}</option>
		@endfor
	</select> To
	<select id="optToHeight" style="width: 40%;border: 1px solid #CCC" fmUri="{{route('showByGender')}}">
		<option></option>
		<option>4ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"4ft ".$i."in"}}</option>
		@endfor
		<option>5ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"5ft ".$i."in"}}</option>
		@endfor
		<option>6ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"6ft ".$i."in"}}</option>
		@endfor
		<option>7ft</option>
		@for($i=1; $i< 12; $i++)
		<option>{{"7ft ".$i."in"}}</option>
		@endfor
	</select>
	</div>
	</div>

	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>

	<div class="row">
	<div class="col-md-12">
	<label>Marital Status</label>
	<select id="optMaritalStatus" fmUri="{{route('showByMarital')}}" class="form-control">
		<option value="">Select</option>
		<option>Unmarried</option>
	    <option>Married</option>
	    <option>Divorced</option>
	    <option>Widow</option>
	    <option>Separated</option>

	</select>
	</div>
	</div>

	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>


	<div class="row">
	<div class="col-md-12">
	<label>Religion</label><br/>
	<select id="optReligion" fmUri="{{route('showByReligion')}}" class="form-control">
	<option value="">Select</option>
    <option>Anglican</option>
    <option>Atheist</option>
    <option>Baptist</option>
    <option>Buddhist/Taoist</option>
    <option>Christian(Catholic)</option>
    <option>Christian(Other)</option>
    <option>Christian(Protestant)</option>
    <option>Evengelical</option>
    <option>Hindu</option>
    <option>Jain</option>
    <option>Jewish</option>
    <option>Methodist</option>
    <option>Mormon/Lds</option>
    <option>Muslim</option>
    <option>Pagan/Earth- Based</option>
    <option>Scientology</option>
    <option>Sikh</option>
    <option>Spiritual But Not Religious</option>
    <option>Not Religious</option>
    <option>Other</option>
	</select>
	</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>


	<div class="row">
	<div class="col-md-12">
	<label>Education</label><br/>
	<select id="optEducation" fmUri="{{route('showByEducation')}}" class="form-control">
	<option value="">Select</option>
    @foreach($profileList as $pl)
    @if($pl->education!="")
    <option>{{$pl->education}}</option>
    @endif
    @endforeach
	</select>
	</div>
	</div>


	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>


	<div class="row">
	<div class="col-md-12">
	<label>Occupation</label><br/>
	<select id="optOccupation" fmUri="{{route('showByOccupation')}}" class="form-control">
	<option value="">Select</option>
    @foreach($profileList as $pl)
    @if($pl->occupation!="")
    <option>{{$pl->occupation}}</option>
    @endif
    @endforeach
	</select>
	</div>
	</div>


	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>


	<div class="row">
	<div class="col-md-12">
	<label>Annual income</label><br/>
	<select id="optFromAnnualInc" style="width: 40%;border: 1px solid #CCC">
	<option value="0" selected="">Any</option>
	<option value="50000">Tk.50 thousand </option>
	<option value="100000">Tk.1 Lakh</option>
	<option value="200000">Tk.2 Lakh</option>
	<option value="300000">Tk.3 Lakh</option>
	<option value="400000">Tk.4 Lakh</option>
	<option value="500000">Tk.5 Lakh</option>
	<option value="600000">Tk.6 Lakh</option>
	<option value="700000">Tk.7 Lakh</option>
	<option value="800000">Tk.8 Lakh</option>
	<option value="900000">Tk.9 Lakh</option>
	<option value="1000000">Tk.10 Lakh</option>
	<option value="1200000">Tk.12 Lakh</option>
	<option value="1400000">Tk.14 Lakh</option>
	<option value="1600000">Tk.16 Lakh</option>
	<option value="1800000">Tk.18 Lakh</option>
	<option value="2000000">Tk.20 Lakh</option>
	<option value="2500000">Tk.25 Lakh</option>
	<option value="3000000">Tk.30 Lakh</option>
	<option value="3500000">Tk.35 Lakh</option>
	<option value="4000000">Tk.40 Lakh</option>
	<option value="4500000">Tk.45 Lakh</option>
	<option value="5000000">Tk.50 Lakh</option>
	<option value="6000000">Tk.60 Lakh</option>
	<option value="7000000">Tk.70 Lakh</option>
	<option value="8000000">Tk.80 Lakh</option>
	<option value="9000000">Tk.90 Lakh</option>
	<option value="10000000">Tk.1 Crore</option>
	</select>To
	<select id="optToAnnualInc" fmUri="{{route('showByAnnualIncome')}}" style="width: 40%;border: 1px solid #CCC">
	<option value="0" selected="">Any</option>
	<option value="50000">Tk.50 thousand </option>
	<option value="100000">Tk.1 Lakh</option>
	<option value="200000">Tk.2 Lakh</option>
	<option value="300000">Tk.3 Lakh</option>
	<option value="400000">Tk.4 Lakh</option>
	<option value="500000">Tk.5 Lakh</option>
	<option value="600000">Tk.6 Lakh</option>
	<option value="700000">Tk.7 Lakh</option>
	<option value="800000">Tk.8 Lakh</option>
	<option value="900000">Tk.9 Lakh</option>
	<option value="1000000">Tk.10 Lakh</option>
	<option value="1200000">Tk.12 Lakh</option>
	<option value="1400000">Tk.14 Lakh</option>
	<option value="1600000">Tk.16 Lakh</option>
	<option value="1800000">Tk.18 Lakh</option>
	<option value="2000000">Tk.20 Lakh</option>
	<option value="2500000">Tk.25 Lakh</option>
	<option value="3000000">Tk.30 Lakh</option>
	<option value="3500000">Tk.35 Lakh</option>
	<option value="4000000">Tk.40 Lakh</option>
	<option value="4500000">Tk.45 Lakh</option>
	<option value="5000000">Tk.50 Lakh</option>
	<option value="6000000">Tk.60 Lakh</option>
	<option value="7000000">Tk.70 Lakh</option>
	<option value="8000000">Tk.80 Lakh</option>
	<option value="9000000">Tk.90 Lakh</option>
	<option value="10000000">Tk.1 Crore</option>
	</select>
	</div>
	</div>

	
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>


	<div class="row">
	<div class="col-md-12">
	<label>City</label><br/>
	<select id="optCity" fmUri="{{route('showByCity')}}" class="form-control">
	  <option value="">Select</option>
      <option value="Dhaka">Dhaka</option>
	  <option value="Chattrogram">Chattrogram</option>
	  <option value="Barishal">Barishal</option>
	  <option value="Rangpur">Rangpur</option>
	  <option value="Rajshahi">Rajshahi</option>
	  <option value="Mymenshing">Mymenshing</option>
	  <option value="Khulna">Khulna</option>
	  <option value="Sylhet">Sylhet</option>
	</select>
	</div>
	</div>


	</form>

	</div>

	<div class="col-md-9">

	<div class="row" style="cursor: pointer;" id="table_display">
	@foreach($profileList as $pl)
	<div class="col-md-4">
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
	<div class="col-md-4"></div>
	<div class="col-md-4">{{ $profileList->links() }}</div>
	<div class="col-md-4"></div>
	</div>

	</div>

</div>

</div>
</div>
</div>
@endsection
@section('js')
<script>
$(document).ready( function() {


function dataTemplate(data)
{
var details = '{{ route("showProfileDetails", ":slug") }}';
details = details.replace(':slug', data.id);

var proposal = '{{ route("sendProposal", ":slug") }}';
proposal = proposal.replace(':slug', data.id);

var favorite = '{{ route("favoriteSomeone", ":slug") }}';
favorite = favorite.replace(':slug', data.id);
var images;
if(data.photo){
	images = "<img class='img-circle' src='{{asset('/profile')}}/"+data.photo+"' alt='User Avatar'>";
}else{
	if(data.sex=="Male"){
		images = "<img class='img-circle' src='{{asset('/image/man.jpg')}}' alt='User Avatar'>";
	}
	else{
	images = "<img class='img-circle' src='{{asset('/image/woman.jpg')}}' alt='User Avatar'>";
	}
}

 $("#table_display").append(""+
 "<div class='col-md-4'>"+
"<div class='box box-widget widget-user w3-hover-shadow'>"+
	"<div class='widget-user-header bg-aqua-active'>"+
	"</div>"+
	"<div class='widget-user-image'>"+
	images+
	"</div>"+
	"<div class='box-footer'>"+
	"<div class='row' style='color: #45B39D;margin:0 auto;'>"+
	"<div class='col-xs-12'>"+
	"<p>"+data.occupation.substr(0, 25)+"</p>"+
	"<p>Age :"+data.age+"</p>"+
	"<p>Hght : "+data.height+"</p>"+
	"</div>"+
	"</div>"+
	"<div class='row'>"+
	"<div class='col-xs-4 border-right'>"+
	"<div class='description-block'>"+
	"<h5 class='description-header'>"+
	"<a href='"+favorite+"'><i class='fa fa-star'></i></a>"+
	"</h5>"+
	"<span class='description-text'>FAVORITE</span>"+
	"</div>"+
	"</div>"+
	"<div class='col-xs-4 border-right'>"+
	"<div class='description-block'>"+
	"<h5 class='description-header'>"+
	"<a href='"+proposal+"'><i class='fa fa-send'></i></a>"+
	"</h5>"+
	"<span class='description-text'>PROPOSAL</span>"+
	"</div>"+
	"</div>"+
	"<div class='col-xs-4'>"+
	"<div class='description-block'>"+
	"<h5 class='description-header'>"+
	"<a href='"+details+"'><i class='fa fa-th'></i></a>"+ 
	"</h5>"+
	"<span class='description-text'>DETAILS</span>"+
	"</div>"+
	"</div>"+
	"</div>"+
	"</div>"+
	"</div>"+
	"</div>"
);
 
}


    $("#rdFemale").on('change', function(e){
    	e.preventDefault();
    	var gender 	= $(this).val(),
    	from_age 	= $( "#fromAge" ).val(),
    	to_age 		= $( "#toAge" ).val(),
    	from_height = $( "#optFromHeight" ).val(),
    	to_height 	= $( "#optToHeight" ).val(),
    	marital 	= $( "#optMaritalStatus" ).val(),
    	religion 	= $( "#optReligion" ).val(),
    	education 	= $( "#optEducation" ).val(),
    	occupation 	= $( "#optOccupation" ).val(),
    	from_inc 	= $( "#optFromAnnualInc" ).val(),
    	to_inc 		= $( "#optToAnnualInc" ).val(),
    	city 		= $( "#optCity" ).val();
    	var urls 	= $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});

    });

    $("#rdMale").on('change', function(e){
    	e.preventDefault();
    	var gender 	= $(this).val(),
    	from_age 	= $( "#fromAge" ).val(),
    	to_age 		= $( "#toAge" ).val(),
    	from_height = $( "#optFromHeight" ).val(),
    	to_height 	= $( "#optToHeight" ).val(),
    	marital 	= $( "#optMaritalStatus" ).val(),
    	religion 	= $( "#optReligion" ).val(),
    	education 	= $( "#optEducation" ).val(),
    	occupation 	= $( "#optOccupation" ).val(),
    	from_inc 	= $( "#optFromAnnualInc" ).val(),
    	to_inc 		= $( "#optToAnnualInc" ).val(),
    	city 		= $( "#optCity" ).val();
    	var urls 	= $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });


    $("#fromAge").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $(this).val();
    	var to_age = $("#toAge").val();
    	var urls = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{
    			gnd:gender,
    			frmAge:from_age,
    			toAge:to_age
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });


    $("#toAge").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $("#fromAge").val();
    	var to_age = $(this).val();
    	var urls = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{
    			gnd:gender,
    			frmAge:from_age,
    			toAge:to_age
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });


    $("#optToHeight").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $(this).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });


    $("#optMaritalStatus").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $(this).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });


$("#optReligion").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( this ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });



$("#optEducation").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( this ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
    });




 $("#optOccupation").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( this ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
  });


 $("#optToAnnualInc").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( this ).val(),
    	city 		 = $( "#optCity" ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
  });


$("#optCity").on('change', function(e){
    	e.preventDefault();
    	var gender;
    	if($('#rdMale').is(':checked')) {
    	 gender = $('#rdMale').val();
    	}else{
    	 gender = $('#rdFemale').val();	
    	}
    	var from_age = $( "#fromAge" ).val(),
    	to_age 		 = $( "#toAge" ).val(),
    	from_height  = $( "#optFromHeight" ).val(),
    	to_height 	 = $( "#optToHeight" ).val(),
    	marital 	 = $( "#optMaritalStatus" ).val(),
    	religion 	 = $( "#optReligion" ).val(),
    	education 	 = $( "#optEducation" ).val(),
    	occupation 	 = $( "#optOccupation" ).val(),
    	from_inc 	 = $( "#optFromAnnualInc" ).val(),
    	to_inc 		 = $( "#optToAnnualInc" ).val(),
    	city 		 = $( this ).val();
    	var urls 	 = $(this).attr('fmUri');
     	//alert(gender);
    	var request = $.ajax({
    		url:urls,
    		method:'GET',
    		dataType:'json',
    		cache: false,
    		data:{	gnd:gender,
    				frmAge:from_age,
    				toAge:to_age,
    				frmHeight:from_height,
    				toHeight:to_height,
    				maritals:marital,
    				religions:religion,
    				educations:education,
    				occupations:occupation,
    				fromIncome:from_inc,
    				toIncome:to_inc,
    				citys:city
    		},
    	});

    	$("#table_display").html('');
    	$("#table_display").slideDown();
        $("#table_display").fadeIn(2000);
    	//location.reload(true);

    	request.done(function( msg ) {
    	console.log(msg.profileList);	
    	 $.each(msg.profileList, function(key, data){
    	 	dataTemplate(data);
          });

		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
  });


});
</script>
@endsection