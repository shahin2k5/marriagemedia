<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Response, Storage, DB;
use App\Role;
use App\User;
use App\Model\CompanyInfo;
use App\Model\SliderImages;
use App\Model\ProfileList;
use App\Model\CountryLists;
use App\Model\PaymentStatus;
use App\Model\Post;
use App\Model\LinkList;
use App\Model\Packages;
use App\Model\AssignPackage;
use App\Model\AgentAssignPackages;
use App\Model\AgentList;
use App\Model\PackagesByAgent;
use App\Model\AssignPackageByAgent;
use App\Model\PaymentToAgent;
use App\Model\Preferences;
use Illuminate\Support\Facades\Validator as Validate;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
    	return view('agent.dashboard');
    }


    public function agentChangePassword(Request $request){

      return view('agent.change_password');

    }

    public function updateAgentPassword(Request $request)
    {

      $email = $request->get('txtEmail');

      $current_pass = $request->get('txtCurrPass');

      $new_pass = $request->get('txtNewPassword');

      $confirm_pass = $request->get('txtConfirmPassword');

      $user = User::find(auth()->user()->id);
        if(!Hash::check($current_pass , $user->password)){
             return back()
                        ->with('warning','The current password does not match the database password');
        }else{


            $validation = Validate::make($request->all(), [
        'txtCurrPass'     => 'required',
        'txtNewPassword'     => 'required|min:6',
        'txtConfirmPassword' => 'required|same:txtNewPassword',
        ]);

        if($validation->fails())
        {
            return back()
                        ->with('warning','Invalid Input! You should enter your New password.New password must be in 6 letters');
        }

            $password = $confirm_pass;
            $user = User::find(auth()->user()->id);
                    $user->password = Hash::make($password);
                    $user->save();
           if($user)
           {
           return back()
                        ->with('success','Your password has been updated into the database!');
            }
            else
            {
                return back()
                        ->with('error','Could not update your password now!');
            }
        }

    }


    public function showProfileForEdit($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.personal_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showFamilyInformation($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.family_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showOccupation($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.occupation',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }



    public function showAbout($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.about',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showPreferences($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.preference',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showFinishForAgent($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.profiles.finish',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showAgentPaidUsers(){
      $profile_list = ProfileList::where('paid_status', 'Paid')->where('added_by','=','Agent')->get();
      $profile_count = ProfileList::where('paid_status', 'Paid')->where('added_by','=','Agent')->count();
      return view('agent.agent_users_paid',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function showAgentUnpaidUsers(){
      $profile_list = ProfileList::where(['paid_status'=>'Unpaid',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->get();
      $profile_count = ProfileList::where(['paid_status'=>'Unpaid',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->count();
      return view('agent.agent_users_unpaid',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }


    public function showAgentUncompleteUsers(){
      $profile_list = ProfileList::where(
        'complete_status', '<', 32)->where([
          'added_by'=>'Agent',
          'edited_by'=>Auth::user()->id
        ])->get();
      $profile_count = ProfileList::where(
        'complete_status', '<', 32)->where([
          'added_by'=>'Agent',
          'edited_by'=>Auth::user()->id
        ])->count();
      return view('agent.agent_users_uncomplete',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }


    public function showAgentPublishedUsers(){
      $profile_list = ProfileList::where([
        'publish_status'=>'Published',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->get();
      $profile_count = ProfileList::where([
        'publish_status'=>'Published',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->count();
      return view('agent.agent_users_published',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }


    public function showAgentUnpublishedUsers(){
      $profile_list = ProfileList::where([
        'publish_status'=>'Unpublished',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->get();
      $profile_count = ProfileList::where([
        'publish_status'=>'Unpublished',
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->count();
      return view('agent.agent_users_unpublish',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }


    public function showAgentAllUsers(){
      $profile_list = ProfileList::where([
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->get();
      $profile_count = ProfileList::where([
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
      ])->count();
      return view('agent.agent_all_users',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }


    public function showAgentUncompleteProfile($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.agent_uncomplete_profile',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }

    public function showAgentAllProfile($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('agent.agent_all_profiles',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showPublishedAgentProById($id){
      $profile_info = ProfileList::where([
        'publish_status'=>'Published',
        'added_by'=>'Agent',
        'id'=>$id
      ])->first();
      return view('agent.agent_view_profile',[
        'profileInfo'=>$profile_info,
      ]);
    }


    public function showUnpublishedAgentProById($id){
      $profile_info = ProfileList::where([
        'publish_status'=>'Unpublished',
        'added_by'=>'Agent',
        'id'=>$id
      ])->first();
      return view('agent.agent_view_profile',[
        'profileInfo'=>$profile_info,
      ]);
    }

    public function changePublishStatusByAgent($id){

      $agent_me = AgentList::where('client_id', Auth::user()->id)->first();

      $check_agent = AgentAssignPackages::where('profile_id', $agent_me->id)->first();

      $agent_pro_count = ProfileList::where('agent_id', Auth::user()->id)->count();

      if($check_agent->Package->limit_profiles<$agent_pro_count){

        return back()->with('warning', 'You have already reached your limit');

      }else{

      $check_status = ProfileList::where('id', $id)->first();
      if($check_status->publish_status=="Unpublished"):
        ProfileList::where('id', $id)->update([
        'publish_status'=>'Published',
        'edited_by'=>Auth::user()->id
        ]);
      else:
        ProfileList::where('id', $id)->update([
        'publish_status'=>'Unpublished',
        'edited_by'=>Auth::user()->id
        ]);
      endif;
      
      $profile_info = ProfileList::where([
        'id'=>$id
      ])->first();
      return view('agent.unpublish_profile',[
        'profileInfo'=>$profile_info,
      ]);
      }//Main If
    }

	public function deleteProfileAgent($id){
      $profile = ProfileList::findOrFail($id);
      unlink('./profile/'.$profile->photo);
      $profile->delete();
      return back()->with('warning','Your profile has been deleted successfully!');
    }


    public function createPersonalForAgent(Request $request, $id){
      $full_name = $request->get('txtFullName');
      $date_of_birth = $request->get('txtDateOfBirth');
      $age = $request->get('txtAge');
      $religion = $request->get('optReligion');
      $sex = $request->get('optSex');
      $blood_group = $request->get('txtBloodGroup');
      
      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->paid_status=="Unpaid"){
        $paid_status = "Unpaid";
      }else{
        $paid_status = "Paid";
      }

      if($check_profile->full_name=="" && $full_name!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'full_name'=>$full_name,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->full_name!="" && $full_name=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'full_name'=>$full_name,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'full_name'=>$full_name, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      if($check_profile->date_of_birth=="" && $date_of_birth!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'date_of_birth'=>$date_of_birth,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->date_of_birth!="" && $date_of_birth=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'date_of_birth'=>$date_of_birth,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'date_of_birth'=>$date_of_birth, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      if($check_profile->age=="" && $age!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'age'=>$age,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->age!="" && $age=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'age'=>$age,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'age'=>$age, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      if($check_profile->religion=="" && $religion!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'religion'=>$religion,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->religion!="" && $religion=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'religion'=>$religion,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'religion'=>$religion, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      if($check_profile->sex=="" && $sex!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'sex'=>$sex,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->sex!="" && $sex=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'sex'=>$sex,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'sex'=>$sex, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      if($check_profile->blood_group=="" && $blood_group!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'blood_group'=>$blood_group,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }elseif ($check_profile->blood_group!="" && $blood_group=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
        $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'blood_group'=>$blood_group,
        'complete_status'=>$count, 
        'agent_id'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'blood_group'=>$blood_group, 
        'agent_id'=>Auth::user()->id
        ]);
      }


      return back()->with('success','Your personal information has been updated successfully!');

    }


    public function createFamilyForAgent(Request $request, $id){
      
      $fathers_name = $request->get('txtFathersName');
      $fathers_occupation = $request->get('txtFathersOccupation');
      $mothers_name = $request->get('txtMothersName');
      $mothers_occupation = $request->get('txtMothersOccupation');
      $siblings = $request->get('txtSiblings');
      $family_value = $request->get('optFamilyValues');
      
      $check_profile = ProfileList::where('id', $id)->first();
      
      if($check_profile->paid_status=="Unpaid"){
        $paid_status = "Unpaid";
      }else{
        $paid_status = "Paid";
      }

      if($check_profile->fathers_name=="" && $fathers_name!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'fathers_name'=>$fathers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->fathers_name!="" && $fathers_name=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'fathers_name'=>$fathers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'fathers_name'=>$fathers_name, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->fathers_occupation=="" && $fathers_occupation!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'fathers_occupation'=>$fathers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->fathers_occupation!="" && $fathers_occupation=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'fathers_occupation'=>$fathers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'fathers_occupation'=>$fathers_occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mothers_name=="" && $mothers_name!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mothers_name'=>$mothers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->mothers_name!="" && $mothers_name=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'mothers_name'=>$mothers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'mothers_name'=>$mothers_name, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mothers_occupation=="" && $mothers_occupation!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mothers_occupation'=>$mothers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->mothers_occupation!="" && $mothers_occupation=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'mothers_occupation'=>$mothers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'mothers_occupation'=>$mothers_occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->siblings=="" && $siblings!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'siblings'=>$siblings,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->siblings!="" && $siblings=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'siblings'=>$siblings,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'siblings'=>$siblings, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->family_values=="" && $family_value!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'family_values'=>$family_value,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->family_values!="" && $family_value=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'family_values'=>$family_value,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'family_values'=>$family_value, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      

      return back()->with('success','Your family information has been updated successfully!');

    }


    public function createOccupationForAgent(Request $request, $id){
      
      $occupation = $request->get('txtOccupation');
      $income = $request->get('txtIncome');
      
      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->paid_status=="Unpaid"){
        $paid_status = "Unpaid";
      }else{
        $paid_status = "Paid";
      }

      if($check_profile->occupation=="" && $occupation!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'occupation'=>$occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->occupation!="" && $occupation=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'occupation'=>$occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'occupation'=>$occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->annual_income=="" && $income!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'annual_income'=>$income,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->annual_income!="" && $income=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'annual_income'=>$income,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'annual_income'=>$income, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      return back()->with('success','Your occupation information has been updated successfully!');

    }


    public function createAboutForAgent(Request $request, $id){
      
      $height = $request->get('opHeight');
      $weight = $request->get('txtWeight');
      $body_type = $request->get('optBodyType');
      $marital_status = $request->get('optMaritalStatus');
      $drink = $request->get('optDrink');
      $smoke = $request->get('optSmoke');
      $diet = $request->get('optDiet');
      $complexion = $request->get('optComplexion');
      $beard = $request->get('optBeard');
      $mustache = $request->get('optMustache');
      $appearance = $request->get('optAppearance');
      $mother_tongue = $request->get('optMotherTongue');
      $created_by = $request->get('optCreatedBy');
      
      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->paid_status=="Unpaid"){
        $paid_status = "Unpaid";
      }else{
        $paid_status = "Paid";
      }

      if($check_profile->height=="" && $height!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'height'=>$height,
        'complete_status'=>$count,
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->height!="" && $height=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'height'=>$height,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'height'=>$height, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->weight=="" && $weight!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'weight'=>$weight,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->weight!="" && $weight=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'weight'=>$weight,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'weight'=>$weight, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->marital_status=="" && $marital_status!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'marital_status'=>$marital_status,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->marital_status!="" && $marital_status=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'marital_status'=>$marital_status,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'marital_status'=>$marital_status,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->body_type=="" && $body_type!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'body_type'=>$body_type,
        'complete_status'=>$count,
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->body_type!="" && $body_type=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'body_type'=>$body_type,
        'complete_status'=>$count,
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'body_type'=>$body_type,
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->drink=="" && $drink!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'drink'=>$drink,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->drink!="" && $drink=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'drink'=>$drink,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'drink'=>$drink, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->smoke=="" && $smoke!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'smoke'=>$smoke,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->smoke!="" && $smoke=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'smoke'=>$smoke,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'smoke'=>$smoke, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->diet=="" && $diet!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'diet'=>$diet,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->diet!="" && $diet=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'diet'=>$diet,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'diet'=>$diet, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->complexion=="" && $complexion!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'complexion'=>$complexion,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->complexion!="" && $complexion=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'complexion'=>$complexion,
        'complete_status'=>$count,
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'complexion'=>$complexion,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->beard=="" && $beard!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'beard'=>$beard,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->beard!="" && $beard=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'beard'=>$beard,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'beard'=>$beard, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->mustache=="" && $mustache!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mustache'=>$mustache,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->mustache!="" && $mustache=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'mustache'=>$mustache,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'mustache'=>$mustache,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->appearance=="" && $appearance!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'appearance'=>$appearance,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->appearance!="" && $appearance=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'appearance'=>$appearance,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'appearance'=>$appearance, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mother_tongue=="" && $mother_tongue!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mother_tongue'=>$mother_tongue,
        'complete_status'=>$count,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->mother_tongue!="" && $mother_tongue=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'mother_tongue'=>$mother_tongue,
        'complete_status'=>$count, 
        'added_by'=>'Agent',
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'mother_tongue'=>$mother_tongue,
        'added_by'=>'Agent', 
        'edited_by'=>Auth::user()->id
        ]);
      }
      

      return back()->with('success','About you information has been updated successfully!');

    }


    public function createEducationForAgent(Request $request, $id){
      
      $education = $request->get('txtEducation');
      $profile_status = $request->get('optStatus');
      $paid_status = '';
      $mobile_no = $request->get('txtMobileNo');
      $address = $request->get('txtAddress');
      $permanent_address = $request->get('txtPermanentAddress');
      $city = $request->get('txtCity');
      $country = $request->get('optCountryName');

      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->paid_status=="Unpaid"){
        $paid_status = "Unpaid";
      }else{
        $paid_status = "Paid";
      }

      if($check_profile->education=="" && $education!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'education'=>$education,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->education!="" && $education=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'education'=>$education,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'education'=>$education, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mobile_no=="" && $mobile_no!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mobile_no'=>$mobile_no,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->mobile_no!="" && $mobile_no=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'mobile_no'=>$mobile_no,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'mobile_no'=>$mobile_no, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->profile_status==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'profile_status'=>$profile_status,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'profile_status'=>$profile_status, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "profile-".Date('Ymdhis')."-".$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./profile/".$filename;

      if($check_profile->photo=="" && $filetmp!=""):
      move_uploaded_file($filetmp, $filepath);
      ProfileList::where('id', $id)->update([
          'photo'=>$filename,
          'paid_status'=>$paid_status
      ]);
      elseif ($check_profile->photo!="" && $filetmp!=""):
      unlink("./profile/".$check_profile->photo);
      move_uploaded_file($filetmp, $filepath);
      ProfileList::where('id', $id)->update([
          'photo'=>$filename,
          'paid_status'=>$paid_status
      ]);
      else:
      ProfileList::where('id', $id)->update([
          'paid_status'=>$paid_status
      ]);
      endif;


      if($check_profile->address=="" && $address!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'address'=>$address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->address!="" && $address=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'address'=>$address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'address'=>$address, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->permanent_address=="" && $permanent_address!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'permanent_address'=>$permanent_address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->permanent_address!="" && $permanent_address=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'permanent_address'=>$permanent_address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'permanent_address'=>$permanent_address, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->city=="" && $city!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'city'=>$city,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->city!="" && $city=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'city'=>$city,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'city'=>$city, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->country=="" && $country!=""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'country'=>$country,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }elseif ($check_profile->country!="" && $country=="") {
        $count = ProfileList::where('id', $id)->value("complete_status");
        if($count>0):
          $count = $count - 1;
        endif;
        ProfileList::where('id', $id)->update([
        'country'=>$country,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }
      else{
        ProfileList::where('id', $id)->update([
        'country'=>$country, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      
      return back()->with('success','You have finished your information successfully!');

    }


    public function insertPreferenceForAgent(Request $request, $id){
      
      $profile = ProfileList::where('client_id', $id)->first();

      $check_preference = Preferences::where([
        'profile_id'=>$profile->id,
        'client_id'=>Auth::user()->id,
      ])->first();

      if(empty($check_preference)):
      Preferences::create([
        'profile_id'=>$profile->id,
        'client_id'=>Auth::user()->id,
        'from_age'=>$request->get('txtFromAge'),
        'to_age'=>$request->get('txtToAge'),
        'from_height'=>$request->get('txtFromHeight'),
        'to_height'=>$request->get('txtToHeight'),
        'religion'=>$request->get('optReligion'),
        'marital_status'=>$request->get('optMaritalStatus'),
        'beard'=>$request->get('optBeard'),
        'mustache'=>$request->get('optMustache'),
        'appearance'=>$request->get('optAppearance'),
        'education'=>$request->get('txtEducation'),
        'body_type'=>$request->get('optBodyType'),
        'drink'=>$request->get('optDrink'),
        'smoke'=>$request->get('optSmoke'),
        'diet'=>$request->get('optDiet'),
        'complexion'=>$request->get('optComplexion'),
        'occupation'=>$request->get('txtOccupation'),
        'from_annual_income'=>$request->get('txtFromIncome'),
        'to_annual_income'=>$request->get('txtToIncome'),
        'country'=>$request->get('optCountry'),
        'city'=>$request->get('optCity'),
        'added_by'=>Auth::user()->id
      ]);
      else:
        Preferences::where([
        'profile_id'=>$profile->id,
        'client_id'=>Auth::user()->id,
        ])->update([
        'profile_id'=>$profile->id,
        'client_id'=>Auth::user()->id,
        'from_age'=>$request->get('txtFromAge'),
        'to_age'=>$request->get('txtToAge'),
        'from_height'=>$request->get('txtFromHeight'),
        'to_height'=>$request->get('txtToHeight'),
        'religion'=>$request->get('optReligion'),
        'marital_status'=>$request->get('optMaritalStatus'),
        'beard'=>$request->get('optBeard'),
        'mustache'=>$request->get('optMustache'),
        'appearance'=>$request->get('optAppearance'),
        'education'=>$request->get('txtEducation'),
        'body_type'=>$request->get('optBodyType'),
        'drink'=>$request->get('optDrink'),
        'smoke'=>$request->get('optSmoke'),
        'diet'=>$request->get('optDiet'),
        'complexion'=>$request->get('optComplexion'),
        'occupation'=>$request->get('txtOccupation'),
        'from_annual_income'=>$request->get('txtFromIncome'),
        'to_annual_income'=>$request->get('txtToIncome'),
        'country'=>$request->get('optCountry'),
        'city'=>$request->get('optCity'),
        'edited_by'=>Auth::user()->id
      ]);
      endif;
      return back()->with('success', 'Your preferences has been saved successfully!');
    }


    public function agentViewThis($id){
      $profile_info = ProfileList::where('id',$id)->first();
      $packages = PackagesByAgent::where([
        'package_for'=>'Client',
        'added_by'=>Auth::user()->id
      ])->get();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      if ($complete_status>=37) {
        $complete_percent = 100;
      }else{
        $complete_percent = round((100 * $complete_status)/37);
      }
      
      return view('agent.unpaid_view_profile',[
        'profileInfo'=>$profile_info,
        'packages'=>$packages,
        'completePercent'=>$complete_percent
      ]);
    }


    public function showPackForAgent(Request $request){
      $pack_id = $request->get('packageId');
      $packages = PackagesByAgent::where('id', $pack_id)->first();
      $today = date('Y-m-d');
      $expire_date = date('Y-m-d', strtotime($today.'+'.$packages->validity_days.' days'));
      return Response::json([
        'success'=>true,
        'packages'=>$packages,
        'expire_date'=>$expire_date
      ]);
    }


    public function insertAssignForAgent(Request $request){

      PaymentToAgent::create([
      'profile_id'=>$request->get('hddProfileId'),
      'package_id'=>$request->get('optPackageName'),
      'payment_method'=>$request->get('optPaymentMethod'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);
      
      $payment_info = PaymentToAgent::where([
        'profile_id'=>$request->get('hddProfileId'),
        'added_by'=>Auth::user()->id
      ])->orderBy('id', 'desc')->first();

      $check_assign = AssignPackageByAgent::where('profile_id', $request->get('hddProfileId'))->first();

      if(empty($check_assign)):
        AssignPackageByAgent::create([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'payment_id'=>$payment_info->id,
        'added_by'=>Auth::user()->id
      ]);

      ProfileList::where('id', $request->get('hddProfileId'))->update([
        'paid_status'=>'Paid',
        'edited_by'=>Auth::user()->id
      ]);
      else:
      AssignPackageByAgent::where('profile_id', $request->get('hddProfileId'))->update([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'payment_id'=>$payment_info->id,
        'edited_by'=>Auth::user()->id
      ]);

      ProfileList::where('id', $request->get('hddProfileId'))->update([
        'paid_status'=>'Paid',
        'edited_by'=>Auth::user()->id
      ]);
      endif;
      
      
      return back()->with('success', 'Package has been assigned successfully!');

    }

    public function showAgentPaidView($id){
      $profile_info = ProfileList::where('id',$id)->first();
      $packages = PackagesByAgent::get();
      $assign_info = AssignPackageByAgent::where('profile_id', $profile_info->id)->first();
      $payment_info = PaymentToAgent::where('profile_id', $id)->first();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      if($complete_status>=37){
        $complete_percent = 100;
      }else{
        $complete_percent = round((100 * $complete_status)/37);  
      }
      
      return view('agent.agent_paid_view',[
        'profileInfo'=>$profile_info,
        'packages'=>$packages,
        'assignInfo'=>$assign_info,
        'paymentInfo'=>$payment_info,
        'completePercent'=>$complete_percent
      ]);
    }


    public function updateAssignForAgent(Request $request){
      
      PaymentToAgent::where([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName')
      ])->update([
      'profile_id'=>$request->get('hddProfileId'),
      'package_id'=>$request->get('optPackageName'),
      'payment_method'=>$request->get('optPaymentMethod'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);
      
      $payment_info = PaymentToAgent::where([
        'profile_id'=>$request->get('hddProfileId'),
        'added_by'=>Auth::user()->id
      ])->orderBy('id', 'desc')->first();

      AssignPackageByAgent::where('profile_id', $request->get('hddProfileId'))->update([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'payment_id'=>$payment_info->id,
        'edited_by'=>Auth::user()->id
      ]);

      ProfileList::where('id', $request->get('hddProfileId'))->update([
        'paid_status'=>'Paid',
        'edited_by'=>Auth::user()->id
      ]);
      
      
      return back()->with('success', 'Information has been updated successfully!');

    }


    public function showUnpubProfile($id){
      $profile_info = ProfileList::where('id',$id)->first();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      if($complete_status>=37):
        $complete_percent = 100;
      else:
        $complete_percent = round((100 * $complete_status)/37);
      endif;
      return view('agent.unpublish_profile',[
        'profileInfo'=>$profile_info,
        'completePercent'=>$complete_percent
      ]);
    }


    public function agentNewProfile(){
      $country_list = CountryLists::get();
      return view('agent.new_profile',[
        'countryList'=>$country_list
      ]); 
    }


    public function createNewProfile(Request $request){
      $full_name = $request->get('txtFullName');
      $date_of_birth = $request->get('txtDateOfBirth');
      $fathers_name = $request->get('txtFathersName');
      $religion = $request->get('optReligion');
      $sex = $request->get('optSex');
      $username = $request->get('txtUsername');
      $paid_status = 'Unpaid';
      $email = $request->get('txtEmail');
      $password = $request->get('txtPassword');
      $occupation = $request->get('txtOccupation');
      $mobile_no = $request->get('txtMobileNo');

      $count = 0;
      if($full_name!=""):
        $count=$count+1;
      endif;
      if($date_of_birth!=""):
        $count=$count+1;
      endif;
      if($fathers_name!=""):
        $count=$count+1;
      endif;
      if($religion!=""):
        $count=$count+1;
      endif;
      if($sex!=""):
        $count=$count+1;
      endif;
      if($occupation!=""):
        $count=$count+1;
      endif;
      if($mobile_no!=""):
        $count=$count+1;
      endif;

      User::create([
        'role_id'=>4,
        'name'=>$full_name, 
        'username'=>$username,
        'email'=>$email, 
        'password'=>bcrypt($password)
      ]);

      $user_seek = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      ProfileList::create([
        'client_id'=>$user_seek->id,
        'full_name'=>$full_name,
        'sex'=>$sex,
        'date_of_birth'=>$date_of_birth,
        'religion'=>$religion,
        'fathers_name'=>$fathers_name,
        'occupation'=>$occupation,
        'mobile_no'=>$mobile_no,
        'paid_status'=>$paid_status,
        'complete_status'=>$count,
        'added_by'=>Auth::user()->role->name,
        'agent_id'=>Auth::user()->id 
      ]);

      return back()->with('success','New profile has been created successfully!');

    }


    public function showExpiryUsers(){
      $profile_info = AssignPackageByAgent::where('added_by', Auth::user()->id)->where('expire_date', '<=', Date('Y-m-d'))->get();
      $count = AssignPackageByAgent::where('added_by', Auth::user()->id)->count();
      return view('agent.expiry_users',[
        'profileList'=>$profile_info,
        'count'=>$count
      ]);
    }


    public function showExpiryView($id){
      $profile_info = ProfileList::where([
        'paid_status'=>'Paid',
        'added_by'=>'Agent',
        'id'=>$id
      ])->first();
      $packages = PackagesByAgent::get();
      $assign_info = AssignPackageByAgent::where('profile_id', $id)->first();
      return view('agent.expiry_view',[
        'profileInfo'=>$profile_info,
        'packages'=>$packages,
        'assignInfo'=>$assign_info
      ]);
    }

    public function showPackagesByAgent(){
      $client_packages = PackagesByAgent::get();
      return view('agent.client_packages',[
        'clientPackages'=>$client_packages
      ]);
    }

    public function showPackageByAgent(){
      return view('agent.new_client_package');
    }

    public function insertPackageByAgent(Request $request){
      PackagesByAgent::create([
        'package_for'=>'Client',
        'name'=>$request->get('txtPackageName'),
        'validity_days'=>$request->get('txtValidityDays'),
        'price'=>$request->get('txtPrice'),
        'added_by'=>Auth::user()->id
      ]);
      return back()->with('success', 'Client package has been created successfully!');
    }



    public function editPackageByAgent($id){
      $package = PackagesByAgent::where('id',$id)->first();
      return view('agent.edit_client_package',[
        'package'=>$package
      ]);
    }


    public function updatePackagesByAgent(Request $request, $id){

      Packages::where('id', $id)->update([
        'name'=>$request->get('txtPackageName'),
        'validity_days'=>$request->get('txtValidityDays'),
        'price'=>$request->get('txtPrice'),
        'edited_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Package has been updated successfully!');
    }


    public function insertExpiryPayment(Request $request){

      PaymentToAgent::create([
      'profile_id'=>$request->get('hddProfileId'),
      'package_id'=>$request->get('optPackageName'),
      'payment_method'=>$request->get('optPaymentMethod'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);
      
      $payment_info = PaymentToAgent::where([
        'profile_id'=>$request->get('hddProfileId'),
        'added_by'=>Auth::user()->id
      ])->orderBy('id', 'desc')->first();

      AssignPackageByAgent::where('profile_id', $request->get('hddProfileId'))->update([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'payment_id'=>$payment_info->id,
        'edited_by'=>Auth::user()->id
      ]);

      ProfileList::where('id', $request->get('hddProfileId'))->update([
        'paid_status'=>'Paid',
        'edited_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Package has been assigned successfully!');

    }

    public function showAgentProfile(){
      $agent_info = AgentList::where('client_id', Auth::user()->id)->first();
      return view('agent.agent_profile',[
        'agentInfo'=>$agent_info
      ]);
    }


    public function updateAgentProfile(Request $request, $id){

      $full_name = $request->get('txtFullName');
      $company_name = $request->get('txtCompanyName');
      $mobile_no = $request->get('txtMobile');
      $address = $request->get('txtAddress');
      $username = $request->get('txtUsername');
      $email = $request->get('txtEmail');
      $password = bcrypt($request->get('txtPassword'));

      $filetmp = $_FILES["flIcon"]["tmp_name"];
      $filename = "agent_icon-".Date('Ymdhis')."-".$_FILES["flIcon"]["name"];
      $filetype = $_FILES["flIcon"]["type"];
      $filepath = "./agentimages/".$filename;

      $filectmp = $_FILES["flCoverPhoto"]["tmp_name"];
      $filecname = "agent_cover-".Date('Ymdhis')."-".$_FILES["flCoverPhoto"]["name"];
      $filectype = $_FILES["flCoverPhoto"]["type"];
      $filecpath = "./agentimages/".$filecname;

      $query_agent = AgentList::where('client_id', $id)->first();

      if(empty($filetmp) && !empty($filectmp)):
      
      unlink("./agentimages/".$query_agent->cover_photo);  
      move_uploaded_file($filectmp, $filecpath);
      User::where('id', $id)->update([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::where('client_id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'cover_photo'=>$filecname,
      'edited_by'=>Auth::user()->id
      ]);

      elseif(!empty($filetmp) && empty($filectmp)):
      unlink("./agentimages/".$query_agent->icon);  
      move_uploaded_file($filetmp, $filepath);
      User::where('id', $id)->update([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::where('client_id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'edited_by'=>Auth::user()->id
      ]);

      elseif(!empty($filetmp) && !empty($filectmp)):
      
      unlink("./agentimages/".$query_agent->icon);  
      unlink("./agentimages/".$query_agent->cover_photo);  

      move_uploaded_file($filetmp, $filepath);
      move_uploaded_file($filectmp, $filecpath);

      User::where('id', $id)->update([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::where('client_id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'cover_photo'=>$filecname,
      'edited_by'=>Auth::user()->id
      ]);
      
      else:
      
      User::where('id', $id)->update([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::where('client_id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'edited_by'=>Auth::user()->id
      ]);

      endif;

      return back()->with('success', 'New Agent has been created successfully!');

    }

    public function showReceivePaymentForAgent(){
      $payments_info = PaymentToAgent::orderBy('verified_by', 'asc')->get();
      $packages = PackagesByAgent::get();
      return view('agent.receive_payment',[
        'paymentsInfo'=>$payments_info,
        'packages'=>$packages
      ]);
    }


    public function verifyPaymentForAgent($id){
      $payments_info = PaymentToAgent::where('id', $id)->first();
      $package = PackagesByAgent::where('id', $payments_info->package_id)->first();
      $today = date('Y-m-d');
      $expire_date = date('Y-m-d', strtotime($today.'+'.$package->validity_days.' days'));
      $check_assign_package = AssignPackageByAgent::where('profile_id', $payments_info->profile_id)->first();
      if(empty($check_assign_package)){
        AssignPackageByAgent::create([
          'profile_id'=>$payments_info->profile_id,
          'package_id'=>$payments_info->package_id,
          'expire_date'=>$expire_date,
          'payment_id'=>$payments_info->id,
          'added_by'=>Auth::user()->id
        ]);
        PaymentToAgent::where('id', $id)->update([
          'verified_by'=>Auth::user()->id
        ]);
        ProfileList::where('id',$payments_info->profile_id)->update([
          'paid_status'=>'Paid'
        ]);
      }else{
        AssignPackageByAgent::where('profile_id',$payments_info->profile_id)->update([
          'profile_id'=>$payments_info->profile_id,
          'package_id'=>$payments_info->package_id,
          'expire_date'=>$expire_date,
          'payment_id'=>$payments_info->id,
          'edited_by'=>Auth::user()->id
        ]);
        PaymentToAgent::where('id', $id)->update([
          'verified_by'=>Auth::user()->id
        ]);
        ProfileList::where('id',$payments_info->profile_id)->update([
          'paid_status'=>'Paid'
        ]);
      }
      return back();
    }


}
