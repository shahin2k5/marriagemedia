@extends('website.app')
@section('content')
<div class="grid_1">
<div class="container">
<div class="breadcrumb1">
<ul>
<a href="index.html"><i class="fa fa-home home_1"></i></a>
<span class="divider">&nbsp;|&nbsp;</span>
<li class="current-page">Payment Method</li>
</ul>
</div>

<div class="row">

<div class="col-md-4">
<div class="box box-widget" style="margin-bottom: 0;">
<div class="box-header with-border">
<img src="{{asset('image/bKash.jpg')}}" width="100%">
</div>
<div class="box-body">
<ol style="margin-left:-10%;font-size: 12px;">
<li>Go to your bKash Mobile Menu by dialing *247#</li>
<li>Choose “Payment”</li>
<li>Enter the Merchant bKash Account Number you want to pay to</li>
<li>Enter the amount you want to pay</li>
<li>Enter a reference* against your payment (you can mention the purpose of the transaction in one word. e.g. Bill)</li>
<li>Enter the Counter Number* (the salesperson at the counter will tell you the number)</li>
<li>Now enter your bKash Mobile Menu PIN to confirm</li>
</ol>
</div>
</div>
</div>

<div class="col-md-4">
<div class="box box-widget" style="margin-bottom: 0;">
<div class="box-header with-border">
<img src="{{asset('image/rocket.jpg')}}" width="100%">
</div>
<div class="box-body">
<ol style="margin-left:-10%;font-size: 12px;">
<li>Go to your rocket Mobile Menu by dialing *322#</li>
<li>Choose “Payment”</li>
<li>Enter the rocket Account Number you want to pay</li>
<li>Enter the amount you want to pay</li>
<li>Now enter your rocket Mobile Menu PIN to confirm</li>
<li>Payment Complete</li>
</ol>
</div>
</div>
</div>

<div class="col-md-4">
<div class="box box-widget" style="margin-bottom: 0;">
<div class="box-header with-border">
<img src="{{asset('image/ucash.jpg')}}" width="85%">
</div>
<div class="box-body">
<ol style="margin-left:-10%;font-size: 12px;">
<li>Go to your UCash Mobile Menu by dialing *268#</li>
<li>Choose “Payment”</li>
<li>Enter the UCash Account Number you want to pay</li>
<li>Enter the amount you want to pay</li>
<li>Now enter your UCash Mobile Menu PIN to confirm</li>
<li>Payment Complete</li>
</ol>
</div>
</div>
</div>

</div>

</div>
</div>

@endsection