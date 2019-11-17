
<div class="footer">
<div class="container">
<div class="col-md-5 col_2">
<h4>{{$aboutPost->title or 'About Us'}}</h4>
<p>{{$aboutPost->description or 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'}}</p>
</div>
<div class="col-md-3 col_2">
<h4>Help & Support</h4>
<ul class="footer_links">
<li><a href="{{route('showLiveHelp')}}">24x7 Live help</a></li>
<li><a href="{{route('showContact')}}">Contact us</a></li>
<li><a href="{{route('showFeedback')}}">Feedback</a></li>
<li><a href="{{route('showFAQs')}}">FAQs</a></li>
</ul>
</div>
<div class="col-md-2 col_2">
<h4>Quick Links</h4>
<ul class="footer_links">
<li><a href="{{route('showPrivacyPolicy')}}">Privacy Policy</a></li>
<li><a href="{{route('showTermsAndConditions')}}">Terms and Conditions</a></li>
<li><a href="{{route('showServices')}}">Services</a></li>
</ul>
</div>
<div class="col-md-2 col_2">
<h4>Social</h4>
<ul class="footer_social">
@foreach($links as $lk)
<li><a href="{{$lk->url}}" target="_blank"><i class="{{$lk->design_icon}} fa1"> </i></a></li>
@endforeach
</ul>
</div>
<div class="clearfix"> </div>
<div class="copy">
<p>Copyright © 2018 Marriage Media. All Rights Reserved</p>
</div>
</div>
</div>