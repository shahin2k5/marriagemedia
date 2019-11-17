<?php
$companyInfo = \App\Model\companyInfo::first();
$links = \App\Model\LinkList::get();
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Marriage-Media') }}</title>

<link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{asset('css/w3.css')}}">

<!-- The fav icon -->
<!-- <link rel="shortcut icon" href="{{asset('image/'.$companyInfo->logo)}}"> -->
    
<!-- Bootstrap Core CSS -->
<link href="{{asset('theme/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- jQuery -->
<!-- <script src="{{asset('theme/jquery/jquery.min.js')}}"></script> -->
<script src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('theme/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Custom Fonts -->
<link href="{{asset('theme/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('adminlte/ionic/css/ionicons.min.css')}}">

<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />


<link href="{{asset('css/backTop.css')}}" rel="stylesheet" type="text/css" />


<!-- Flexible Multi-item carousel -->

<link href="{{asset('css/resCarousel.css')}}" rel="stylesheet" type="text/css" />


<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>

<style>
        
        .p0, .p8 {
            padding: 0;
        }
        
        .resCarousel-inner .item {
            /*border: 4px solid #eee;*/
            /*vertical-align: top;*/
            text-align: center;
        }
        
        .resCarousel-inner .item .tile div,
        .banner .item div {
            display: table;
            width: 100%;
            min-height: 50px;
            text-align: center;
            /*box-shadow: 0 1px 1px rgba(0, 0, 0, .1);*/
        }
        
        .resCarousel-inner .item h1 {
            display: table-cell;
            vertical-align: middle;
            color: white;
        }
        
        .banner .item div {
            background: url('demoImg.jpg') center top no-repeat;
            background-size: cover;
            min-height: 550px;
        }
        
        .item .tile div {
            background-size: cover;
            height: 100px;
            color: white;
        }
        
        .item div h1 {
            background: rgba(0, 0, 0, .4);
        }
    </style>

@yield('css')
</head>
<body>
<div class="grid_1">
<div class="container-fluid">
<div class="w3-card-4">
<!-- ============================  Navigation Start =========================== -->
@include('website.navigation_bar')
<!-- ============================  Navigation End ============================ -->

@yield('content')


@include('website.footer')
</div>
</div>
</div>
<script type="text/javascript">
$(window).load(function() {
$("#flexiselDemo3").flexisel({
visibleItems: 6,
animationSpeed: 1000,
autoPlay:false,
autoPlaySpeed: 3000,    		
pauseOnHover: true,
enableResponsiveBreakpoints: true,
responsiveBreakpoints: { 
portrait: { 
changePoint:480,
visibleItems: 1
}, 
landscape: { 
changePoint:640,
visibleItems: 2
},
tablet: { 
changePoint:768,
visibleItems: 3
}
}
});

});
</script>
<script type="text/javascript" src="{{asset('js/jquery.flexisel.js')}}"></script>

 <script>
        //ResCarouselCustom();
        var pageRefresh = true;

        function ResCarouselCustom() {
            var items = $("#dItems").val(),
                slide = $("#dSlide").val(),
                speed = $("#dSpeed").val(),
                interval = $("#dInterval").val()

            var itemsD = "data-items=\"" + items + "\"",
                slideD = "data-slide=\"" + slide + "\"",
                speedD = "data-speed=\"" + speed + "\"",
                intervalD = "data-interval=\"" + interval + "\"";


            var atts = "";
            atts += items != "" ? itemsD + " " : "";
            atts += slide != "" ? slideD + " " : "";
            atts += speed != "" ? speedD + " " : "";
            atts += interval != "" ? intervalD + " " : ""

            //console.log(atts);

            var dat = "";
            dat += '<h4 >' + atts + '</h4>'
            dat += '<div class=\"resCarousel\" ' + atts + '>'
            dat += '<div class="resCarousel-inner">'
            for (var i = 1; i <= 14; i++) {
                dat += '<div class=\"item\"><div><h1>' + i + '</h1></div></div>'
            }
            dat += '</div>'
            dat += '<button class=\'btn btn-default leftRs\'><i class=\"fa fa-fw fa-angle-left\"></i></button>'
            dat += '<button class=\'btn btn-default rightRs\'><i class=\"fa fa-fw fa-angle-right\"></i></button>    </div>'
            console.log(dat);
            $("#customRes").html(null).append(dat);

            if (!pageRefresh) {
                ResCarouselSize();
            } else {
                pageRefresh = false;
            }
            //ResCarouselSlide();
        }

        $("#eventLoad").on('ResCarouselLoad', function() {
            //console.log("triggered");
            var dat = "";
            var lenghtI = $(this).find(".item").length;
            if (lenghtI <= 30) {
                for (var i = lenghtI; i <= lenghtI + 10; i++) {
                    dat += '<div class="item"><div class="tile"><div><h1>' + (i + 1) + '</h1></div><h3>Title</h3><p>content</p></div></div>'
                }
                $(this).append(dat);
            }
        });
    </script>
    <script src="js/resCarousel.js"></script>

<a id='backTop'>Back To Top</a>
<script src="{{asset('js/jquery.backTop.min.js')}}"></script>
        <script>
            $(document).ready( function() {
                $('#backTop').backTop({
                    'position' : 1600,
                    'speed' : 500,
                    'color' : 'red',
                });
            });
        </script>

@yield('js')

</body>
</html>
