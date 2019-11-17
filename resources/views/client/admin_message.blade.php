@extends('client.app')

@section('content')

<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-envelope"></i> Message</a></li>
<li><a href="{{route('client.showInbox')}}"> Inbox</a></li>
<li class="active">Reply Message</li>
</ol>
<br/>
<div class="row">
<div class="col-md-12">

@if(Session::has('success'))
  <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> {{Session::get('success')}}
  </div>
  @endif

  @if(Session::has('warning'))
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> {{Session::get('warning')}}
  </div>
  @endif

  </div>
  </div>

</section>



<!-- Main content -->
<section class="content">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">View Message</h3>
<a href="{{route('client.showInbox')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i></a>
</div><!-- /.box-header -->
<div class="container">
  <div class="row">

    <div class="col-md-6">
		
		
		@foreach($messageList as $ml)
			<dl>
				<dt>Subject : {{$ml->title or ''}}</dt>
				<dd>Message : {{$ml->description or ''}}</dd>
			</dl>
		@endforeach
    </div>


	</div>
</div>

  
    <!-- form start -->
    <form action="{{route('client.sendAdminMessage')}}" method="post">
      {!! csrf_field() !!}
    <div class="box-body">
    <div class="form-group">
    <!-- <label>Subject</label> -->
    <input type="hidden" name="txtTitle" value="Reply Message" />
    </div>
      <div class="form-group">
        <label for="txtReplyMessage">Reply Message:</label>
        <textarea class="form-control" name="txtMessage" id="txtReplyMessage" required="required"></textarea>
      </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
    <button type="submit" class="btn btn-primary">Send</button>
    </div>
    </form>



</div><!-- /.box -->
</section>
@endsection