<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion2-">Family Information <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion2-" class="jb-accordion-content collapse ">

<form action="{{route('admin.insertFamily')}}" method="post">
  {!! csrf_field() !!}
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Name</label>
<input type="text" name="txtFathersName" class="form-control" placeholder="Fathers Name" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Father(s) Occupation</label>
<input type="text" name="txtFathersOccupation" class="form-control" placeholder="Fathers Occupation" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Name</label>
<input type="text" name="txtMothersName" class="form-control" placeholder="Mothers Name" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mother(s) Occupation</label>
<input type="text" name="txtMothersOccupation" class="form-control" placeholder="Mothers Occupation" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Siblings</label>
<input type="text" name="txtSiblings" class="form-control" placeholder="3 brothers and 2 sisters" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Family Values</label>
<select name="optFamilyValues" class="form-control">
  <option>High Class</option>
  <option>High Middle Class</option>
  <option>Middle Class</option>
</select>
</div>
</div>

</div>


<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion3">Occupation <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion3" class="jb-accordion-content collapse ">
<form action="{{route('admin.insertOccupation')}}" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Occupation</label>
<input type="text" name="txtOccupation" class="form-control form-check-label" placeholder="Software Engineer, Government Service holder" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Annual Income (USD)</label>
<input type="number" name="txtIncome" class="form-control form-check-label" placeholder="3500" />
</div>
</div>

</div>

<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>


</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>

<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion4">About <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion4" class="jb-accordion-content collapse ">

<form action="" method="post">
  {!! csrf_field() !!}

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Height</label>
<input type="text" name="txtHeight" class="form-control" placeholder="5 feet 10 inch" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Weight</label>
<input type="text" name="txtWeight" class="form-control" placeholder="78 kg" />
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Body Type</label>
<select name="optBodyType" class="form-control ">
  <option>Normal</option>
  <option>Slim</option>
  <option>Athletic</option>
  <option>Average</option>
  <option>Fat</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Marital Status</label>
<select name="optMaritalStatus" class="form-control ">
  <option>Unmarried</option>
  <option>Married</option>
  <option>Divorced</option>
  <option>Widow</option>
  <option>Separated</option>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Drink</label>
<select name="optDrink" class="form-control ">
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Smoke</label>
<select name="optSmoke" class="form-control ">
  <option>Yes</option>
  <option>No</option>
  <option>Occationaly</option>
  <option>Never</option>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Diet</label>
<select name="optDiet" class="form-control ">
  <option>Non-Vegetarian</option>
  <option>Vegetarian</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Complexion</label>
<select name="optComplexion" class="form-control ">
  <option>Fair</option>
  <option>Very Fair</option>
  <option>Black</option>
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Mother Tongue</label>
<select name="optMotherTongue" class="form-control ">
  <option>Bangla</option>
  <option>English</option>
  <option>Hindi</option>
  <option>Urdu</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Created By</label>
<select name="optCreatedBy" class="form-control">
  <option>Self</option>
  <option>Guardian</option>
  <option>Relative</option>
  <option>Other</option>
</select>
</div>
</div>

</div>



<div class="form-group">
  <button type="submit" class="btn btn-warning pull-right">Save / Update</button>
</div>

</form>
<br/>
</div>
<p><!-- /.collapse --></p>
</div>



<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion5">Finish <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion5" class="jb-accordion-content collapse ">

<form action="" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Photo</label>
    <input type="file" name="flPhoto" class="form-control">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Education</label>
    <input type="text" name="txtEducation" class="form-control" value="{{$profileInfo->education or ''}}" >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <label>Profile Status</label>
    <select class="form-control" name="optStatus">
      <option>Public</option>
      <option>Private</option>
      <option>Protected</option>
    </select>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Mobile No</label>
      <input type="number" name="txtMobileNo" class="form-control" />
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Address</label>
      <textarea name="txtAddress" class="form-control"></textarea>
    </div>
  </div>
  <div class="col-md-6">
    <label>Country Name</label>
    <select class="form-control" name="optCountryName">
      <option value="">SELECT COUNTRY</option>
@foreach($countryList as $cl)
      <option>{{$cl->name}}</option>
@endforeach
    </select>
  </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="txtEmail" class="form-control" required="required" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="txtPassword" class="form-control" required="required" />
		</div>
	</div>
</div>

<div class="form-group">
      <button type="submit" class="btn btn-warning pull-right">Save & Finish</button>
    </div>
</form>

<br/>
</div>
<p><!-- /.collapse --></p>
</div>



<div class="accordation">
<div class="jb-accordion-wrapper">
<div class="jb-accordion-title"><button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#accordion-1-">Personal Information  <i class="fa fa-angle-down"> </i></button></div>
<p><!-- /.accordion-title -->
</p><div id="accordion-1-" class="jb-accordion-content collapse" style="height: auto;">

<br/>
</div>
<p><!-- /.collapse --></p>
</div>

</div>