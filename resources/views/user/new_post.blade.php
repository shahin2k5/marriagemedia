@extends('user.app')
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Post</li>
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
<form action="{{route('user.insertNewPost')}}" method="post" enctype="multipart/form-data">
	{!! csrf_field() !!}

<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Post</h3>
<span class="pull-right">	
<a href="{{route('user.showNewPost')}}" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>
</span>

</div><!-- /.box-header -->

<div class="box-body">

<div class="row">
<div class="col-md-7">

<div class="form-group">
<label>Title</label>
<input type="text" name="txtTitle" class="form-control" autofocus />
</div>

<div class="form-group">
<label>Description</label>
<textarea name="txtDescription" class="form-control" rows="10" cols="30"></textarea>
</div>

</div>
<div class="col-md-5">

<div class="form-group">
<label>Categories</label>
<select name="optCategories" class="form-control">
<option value="">Select Category</option>
<option>About Us</option>
<option>Agent</option>
<option>Our Success Story</option>
<option>Privacy Policy</option>
<option>Terms and Conditions</option>
<option>Services</option>
<option>24x7 Live help</option>
<option>Feedback</option>
<option>FAQs</option>
</select>
</div>

<div class="form-group">
<label>Feature Image</label>
<input type="file" id="files" name="files" class="form-control input-lg text-green" />
</div>

</div>
</div>

</div><!-- /.box-body -->

<div class="box-footer">
<button type="submit" class="btn btn-primary btn-sm">Save</button>
</div>
</div><!-- /.box -->
</form>
</section>
<script type="text/javascript" src="{{asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" width = '100%' title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\"><button class = 'btn btn-danger btn-block'>Delete</button></span>" +
            "</span>").insertBefore("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();

          });
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>

@endsection
