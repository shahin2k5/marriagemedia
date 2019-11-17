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
<div class="container-fluid">
  <div class="row">

    <div class="col-md-4">
    <dl>
      <dt>Subject : {{$messageView->title or ''}}</dt>
      <dd>Message : {{$messageView->description or ''}}</dd>
    </dl>
    
    @foreach($sender as $sd)
      <dl>
        <dt>Subject : <!-- {{$sd->title or ''}} -->Sent Message</dt>
        <dd>Message : {{$sd->description or ''}}</dd>
      </dl>
    @endforeach
    </div>

    <div class="col-md-4">
      @foreach($receiver as $rc)
      <dl>
        <dt>Subject : <!-- {{$rc->title or ''}} -->Receive Message</dt>
        <dd>Message : {{$rc->description or ''}}</dd>
      </dl>
    @endforeach
    </div>


    <div class="col-md-4">
      @if($messageView->SenderProfile->photo!="")
        <img src="{{asset('./profile/'.$messageView->SenderProfile->photo)}}" class="img-responsive" width="100%" />
      @else
        <img src="{{asset('./image/man.jpg')}}" class="img-responsive" width="100%" />
      @endif
    </div>


	</div>
</div>


@if(!empty($assignPackage))
     
    <!-- form start -->
    <form action="{{route('client.sendMessageByClient')}}" method="post">
      {!! csrf_field() !!}
    <div class="box-body">
    <input type="hidden" name="txtReiverId" value="{{$messageView->SenderProfile->id}}" />
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

@elseif(!empty($agentAssignPk))
  
    <!-- form start -->
    <form action="{{route('client.sendMessageByClient')}}" method="post">
      {!! csrf_field() !!}
    <div class="box-body">
    <input type="hidden" name="txtReiverId" value="{{$messageView->SenderProfile->id}}" />
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


@else
    <div style="padding: 2%;">
      <a href="{{route('client.viewProfile')}}" class="btn btn-danger btn-sm">Make Payment</a>
    </div>
@endif

</div><!-- /.box -->
</section>
@endsection