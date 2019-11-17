@extends('client.app')
@section('css')
<link href="{{asset('css/profile_style.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<section class="content-header">
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('client.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Complete Profile</li>
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
<h3 class="box-title">Complete Profile</h3>
</div><!-- /.box-header -->

<div class="box-body">

<div class="wizards">
                <div class="progressbar">
                    <div class="progress-line" data-now-value="12.11" data-number-of-steps="5" style="width: 12.11%;"></div> <!-- 19.66% -->
                </div>
                <div class="form-wizard active">
                    <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                    <p>License</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-user"></i></div>
                    <p>About</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-key"></i></div>
                    <p>Account</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-globe"></i></div>
                    <p>Website</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                    <p>Finish</p>
                </div>
            </div>
            <fieldset>
                <iframe src="license.txt"></iframe>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="yes"> I agree with this license
                </label>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset>
            <fieldset>
                <h4>Input personal data</h4>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama anda"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Surel anda"/>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Nomor telpon anda"/>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Alamat anda"></textarea>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset>
            <fieldset>
                <h4>Input account info</h4>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Nama pengguna"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Kata sandi"/>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset>
            <fieldset>
                    <h4>Input website info</h4>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Judul website"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" placeholder="Deskripsi website"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Website URL</label>
                        <input type="text" name="sites" class="form-control" placeholder="Alamat website"/>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" placeholder="Category website"/>
                    </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset>
            <fieldset>
                <div class="jumbotron text-center">
                <h1>Please click submit button to save your data</h1>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Previous</button>
                    <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </fieldset>

</div>
</div>
</section>
@endsection
@section('js')
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/profile_script.js')}}"></script>
@endsection