<form action="{{route('showAdvanceSearch')}}" method="post">
  {!! csrf_field() !!}
<div class="row">

  <div class="col-md-2">
    <label style="color: white;">Looking For</label>
    <select name="optLookingFor" class="form-control">
    <option value="">Select </option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>
  </div>

  <div class="col-md-4">
    <label style="color: white;">Age</label><br/>
    <input name="fromAge" class="transparent" placeholder="From:" style="width: 45%;height: 35px" type="number" value="20">&nbsp;-&nbsp;<input name="toAge" class="transparent" placeholder="To:" style="width: 45%;height: 35px" type="number" value="50">
  </div>

  
  <div class="col-md-2" style="margin-left: -1.5%;">
    <label style="color: white;">Religion</label>
    <select name="optReligion" class="form-control">
    
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


  <div class="col-md-2">
  <label style="color: white;">City</label>
  <select name="optCity" class="form-control">
  <option value="">Select City</option>
  <option value="Dhaka">Dhaka</option>
  <option value="Chottogram">Chottogram</option>
  <option value="Barishal">Barishal</option>
  <option value="Rangpur">Rangpur</option>
  <option value="Rajshahi">Rajshahi</option>
  <option value="Mymenshing">Mymenshing</option>
  <option value="Khulna">Khulna</option>
  <option value="Sylhet">Sylhet</option>
  </select>    
  </div>
  

  <div class="col-md-2">
    <label style="color: white;">&nbsp;Search</label>
    <input id="submit-btn" class="hvr-wobble-vertical btn btn-success form-control" type="submit" value="Quick Search">    
  </div>

  <!-- <div class="col-md-2">
    <label style="color: white;">&nbsp;</label>
    <a href="#" class="btn btn-default btn-sm">Advance Searach</a>    
  </div> -->

</div>
</form>