 <!-- class="btn-group"  -->
<div style="padding-left:5%;">
      <a href="{{route('admin.showProfileForEdit', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Personal Info</a>
      <a href="{{route('admin.showFamilyInformation', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-list"></i> Family Info</a>
      <a href="{{route('admin.showOccupation', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-book"></i> Occupation</a>
      <a href="{{route('admin.showAbout', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i> About</a>
      <a href="{{route('admin.showPreferences', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-briefcase"></i> Preference</a>
      <a href="{{route('admin.showFinish', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-th"></i> Finish</a>
    </div> 