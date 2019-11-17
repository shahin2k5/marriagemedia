 <!-- class="btn-group"  -->
<div style="padding-left:5%;">
      <a href="{{route('user.showProfileForEdit', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Personal Info</a>
      <a href="{{route('user.showFamilyInformation', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-list"></i> Family Info</a>
      <a href="{{route('user.showOccupation', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-book"></i> Occupation</a>
      <a href="{{route('user.showAbout', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i> About</a>
      <a href="{{route('user.showPreferences', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-briefcase"></i> Preference</a>
      <a href="{{route('user.showFinish', $id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-th"></i> Finish</a>
    </div> 