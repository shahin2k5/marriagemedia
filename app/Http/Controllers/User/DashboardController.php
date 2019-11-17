<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Response, Storage, DB;
use App\Role;
use App\User;
use App\Model\CompanyInfo;
use App\Model\SliderImages;
use App\Model\ProfileList;
use App\Model\CountryLists;
use App\Model\CityList;
use App\Model\PaymentStatus;
use App\Model\Post;
use App\Model\LinkList;
use App\Model\Packages;
use App\Model\AssignPackage;
use App\Model\AgentList;
use App\Model\PaymentsInfo;
use App\Model\TeamMember;
use App\Model\AgentAssignPackages;
use Illuminate\Support\Facades\Validator as Validate;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    public function index(){
    	return view('user.dashboard');
    }


    public function showChangePaswordForm(Request $request){

    	return view('user.change_password');

    }

    public function updateInfoForAdmin(Request $request)
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


    public function showCompanyInfo(){
      $company_info = CompanyInfo::first();
      return view('user.company_info',[
        'companyInfo'=>$company_info
      ]);
    }


    public function createCompanyInfo(Request $request){

        $company_name = $request->get('txtName');
        $address = $request->get('txtAddress');
        $phone = $request->get('txtPhoneNo');
        $mobile_no = $request->get('txtMobileNo');
        $email = $request->get('txtEmailId');

        $filetmp  = $_FILES["flLogoIcon"]["tmp_name"];
        $filename = "logo-".$_FILES["flLogoIcon"]["name"];
        $filetype = $_FILES["flLogoIcon"]["type"];
        $filepath = "./image/".$filename;

        $company_info_check = CompanyInfo::first();

        if(empty($company_info_check)){
        	if($filetmp==""):

        		CompanyInfo::create([
		          'company_name'=>$company_name,
		          'address'=>$address,
		          'phone'=>$phone,
		          'mobile_no'=>$mobile_no,
		          'email'=>$email,
		          'added_by'=>Auth::user()->id
		        ]);

        	else:
        		
        		move_uploaded_file($filetmp, $filepath);

		        CompanyInfo::create([
		          'company_name'=>$company_name,
		          'address'=>$address,
		          'phone'=>$phone,
		          'mobile_no'=>$mobile_no,
		          'email'=>$email,
		          'logo'=>$filename,
		          'added_by'=>Auth::user()->id
		        ]);

        	endif;
        }else{
        	if($filetmp==""):

        		CompanyInfo::orderBy('id', 'desc')->update([
		          'company_name'=>$company_name,
		          'address'=>$address,
		          'phone'=>$phone,
		          'mobile_no'=>$mobile_no,
		          'email'=>$email,
		          'edited_by'=>Auth::user()->id
		        ]);

        	else:

        		unlink("./image/".$company_info_check->logo);

        		move_uploaded_file($filetmp, $filepath);

		        CompanyInfo::orderBy('id', 'desc')->update([
		          'company_name'=>$company_name,
		          'address'=>$address,
		          'phone'=>$phone,
		          'mobile_no'=>$mobile_no,
		          'email'=>$email,
		          'logo'=>$filename,
		          'edited_by'=>Auth::user()->id
		        ]);


        	endif;
        }


        return back()->with('success', 'Company information has been saved or updated successfully!');

    }


    public function showSliderImage(){
      return view('user.slider');
    }

    public function createSlider(Request $request){

      $filetmp = $_FILES["flSliderImage"]["tmp_name"];
      $filename = "slider-".Date('Ymdhis')."-".$_FILES["flSliderImage"]["name"];
      $filetype = $_FILES["flSliderImage"]["type"];
      $filepath = "./slider/".$filename;

      move_uploaded_file($filetmp, $filepath);

      $title = $request->get('txtSliderText');
      
      SliderImages::create([
        'image'=>$filename,
        'title'=>$title,
        'added_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Slider image has been inserted into database!');
    }


    public function showSliderList(){
      $slider_images = SliderImages::get();
      return view('user.sliderList',[
        'sliderImages'=>$slider_images
      ]);
    }

    public function deleteSliderImage($id){
      $image_for = SliderImages::findOrFail($id);
      unlink('slider/'.$image_for->image);
      $image_for->delete();
      return back();
    }

    public function showPaidUsers(){
      $profile_list = ProfileList::where([
        'paid_status'=>'Paid'
      ])->where('added_by','!=','Agent')->get();
      $profile_count = ProfileList::where('paid_status', 'Paid')->where('added_by','!=','Agent')->count();
      return view('user.users_paid',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function showUnpaidUsers(){
      $profile_list = ProfileList::where('paid_status', 'Unpaid')->where('added_by','!=','Agent')->get();
      $profile_count = ProfileList::where('paid_status', 'Unpaid')->where('added_by','!=','Agent')->count();
      return view('user.users_unpaid',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function paidStatusChange($id){
      $check_profile_paid = ProfileList::where('id', $id)->first();
      if($check_profile_paid->paid_status=="Unpaid"){
        ProfileList::where('id', $id)->update([
          'paid_status'=>'Paid',
          'edited_by'=>Auth::user()->id
        ]);
        PaymentStatus::create([
          'profile_id'=>$id,
          'status'=>'Paid',
          'added_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
          'paid_status'=>'Unpaid',
          'edited_by'=>Auth::user()->id
        ]);
        PaymentStatus::create([
          'profile_id'=>$id,
          'status'=>'Unpaid',
          'added_by'=>Auth::user()->id
        ]);
      }
      return back();
    }

    public function showUncompleteUsers(){
      $profile_list = ProfileList::where('complete_status','<', 32)->where('added_by','!=','Agent')->get();
      $profile_count = ProfileList::where('complete_status','<', 32)->where('added_by','!=','Agent')->count();
      return view('user.users_uncomplete',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function showAllUsers(){
      $profile_list = ProfileList::where('added_by', '!=', 'Agent')->get();
      $profile_count = ProfileList::where('added_by', '!=', 'Agent')->count();
      $fromAge="";
      $toAge="";
      $maritalStatus="";
      $religion="";
      $photo = "";
      return view('user.all_users',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count,
        'fromAge'=>$fromAge,
        'toAge'=>$toAge,
        'maritalStatus'=>$maritalStatus,
        'religion'=>$religion,
        'photo'=>$photo
      ]);
    }


    public function allsearch(Request $request){

        $from_age       = $request->get('optFromAge');
        $to_age         = $request->get('optToAge');
        $marital_status = $request->get('optMaritalStatus');
        $religion       = $request->get('optReligion');
        $photo          = $request->get('optPhoto');



        if(!empty($from_age) && !empty($to_age) && !empty($photo) ){

          if($photo=="All"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->whereBetween('age', [$from_age, $to_age])->get();
            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->whereBetween('age', [$from_age, $to_age])->count();

          }elseif($photo=="With Photo"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();
            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }else{

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->get();
            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($marital_status) && !empty($photo)){

          if($photo=="All"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->whereBetween('age', [$from_age, $to_age])->count();

          }elseif($photo=="With Photo"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }else{

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('marital_status', $marital_status)->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($religion) && !empty($photo)){

          if($photo=="All"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->whereBetween('age', [$from_age, $to_age])->count();

          }elseif($photo=="With Photo"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }else{

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where('religion', $religion)->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($marital_status) && !empty($religion) && !empty($photo)){

          if($photo=="All"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->count();


          }elseif($photo=="With Photo"){

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->count();

          }else{

            $profile_list = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $profile_count = ProfileList::where('added_by', '!=', 'Agent')->where([
              'marital_status'=>$marital_status,
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->count();

          }

        }

        return view('user.all_users',[
          'profileList'=>$profile_list,
          'profileCount'=>$profile_count,
          'fromAge'=>$from_age,
          'toAge'=>$to_age,
          'maritalStatus'=>$marital_status,
          'religion'=>$religion,
          'photo'=>$photo
        ]);
      
    }

    public function showPublishedUsers(){
      $profile_list = ProfileList::where('publish_status','Published')->get();
      $profile_count = ProfileList::where('publish_status','Published')->count();
      return view('user.users_published',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function showPublishedUsersById($id){
      $profile_info = ProfileList::where([
        'publish_status'=>'Published',
        'id'=>$id
      ])->first();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      if($complete_status>=37):
        $complete_percent = 100;
      else:
        $complete_percent = round((100 * $complete_status)/37);
      endif;
      return view('user.view_profile',[
        'profileInfo'=>$profile_info,
        'completePercent'=>$complete_percent
      ]);
    }

    public function showUnpublishedUsers(){
      $profile_list = ProfileList::where('publish_status','Unpublished')->get();
      $profile_count = ProfileList::where('publish_status','Unpublished')->count();
      return view('user.users_unpublished',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function showUnpublishedUsersById($id){
      $profile_info = ProfileList::where([
        'publish_status'=>'Unpublished',
        'id'=>$id
      ])->first();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      $complete_percent = round((100 * $complete_status)/37);
      return view('user.view_profile',[
        'profileInfo'=>$profile_info,
        'completePercent'=>$complete_percent
      ]);
    }

    public function changePublishStatus($id){
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
      return view('user.view_profile',[
        'profileInfo'=>$profile_info,
      ]);

    }

    public function showSearchUsers(){
      $profile_list = ProfileList::get();
      $profile_count = ProfileList::count();
      return view('user.search_users',[
        'profileList'=>$profile_list,
        'profileCount'=>$profile_count
      ]);
    }

    public function deleteProfile($id){
      $profile = ProfileList::findOrFail($id);
      unlink('./profile/'.$profile->photo);
      $profile->delete();
      return back()->with('warning','Your profile has been deleted successfully!');
    }

    public function showProfileForEdit($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.personal_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showFamilyInformation($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.family_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showOccupation($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.occupation',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }



    public function showAbout($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.about',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showPreferences($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.preference',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }


    public function showFinish($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.finish',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list,
        'id'=>$id
      ]);
    }

    public function createPersonalForAdmin(Request $request, $id){
      $full_name = $request->get('txtFullName');
      $date_of_birth = $request->get('txtDateOfBirth');
      $age = $request->get('txtAge');
      $religion = $request->get('optReligion');
      $sex = $request->get('optSex');
      $blood_group = $request->get('txtBloodGroup');
      $paid_status = 'Unpaid';

      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->full_name==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'full_name'=>$full_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'full_name'=>$full_name, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->date_of_birth==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'date_of_birth'=>$date_of_birth,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'date_of_birth'=>$date_of_birth, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->age==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'age'=>$age,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'age'=>$age, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->religion==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'religion'=>$religion,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'religion'=>$religion, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->sex==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'sex'=>$sex,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'sex'=>$sex, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->blood_group==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'blood_group'=>$blood_group,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'blood_group'=>$blood_group, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      return back()->with('success','Your personal information has been updated successfully!');

    }


    public function createFamilyForAdmin(Request $request, $id){
      
      $fathers_name = $request->get('txtFathersName');
      $fathers_occupation = $request->get('txtFathersOccupation');
      $mothers_name = $request->get('txtMothersName');
      $mothers_occupation = $request->get('txtMothersOccupation');
      $siblings = $request->get('txtSiblings');
      $family_value = $request->get('optFamilyValues');
      $paid_status = 'Unpaid';

      $check_profile = ProfileList::where('id', $id)->first();
      
      if($check_profile->fathers_name==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'fathers_name'=>$fathers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'fathers_name'=>$fathers_name, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->fathers_occupation==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'fathers_occupation'=>$fathers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'fathers_occupation'=>$fathers_occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mothers_name==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mothers_name'=>$mothers_name,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'mothers_name'=>$mothers_name, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mothers_occupation==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mothers_occupation'=>$mothers_occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'mothers_occupation'=>$mothers_occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->siblings==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'siblings'=>$siblings,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'siblings'=>$siblings, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->family_values==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'family_values'=>$family_value,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'family_values'=>$family_value, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      

      return back()->with('success','Your family information has been updated successfully!');

    }


    public function createOccupationForAdmin(Request $request, $id){
      
      $occupation = $request->get('txtOccupation');
      $income = $request->get('txtIncome');
      $paid_status = 'Unpaid';
      
      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->occupation==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'occupation'=>$occupation,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'occupation'=>$occupation, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->annual_income==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'annual_income'=>$income,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'annual_income'=>$income, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      return back()->with('success','Your occupation information has been updated successfully!');

    }


    public function createAboutForAdmin(Request $request, $id){
      
      $height = $request->get('optHeight');
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
      $paid_status = 'Unpaid';
      $created_by = $request->get('optCreatedBy');
      
      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->height==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'height'=>$height,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'height'=>$height, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->weight==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'weight'=>$weight,
        'complete_status'=>$count, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'weight'=>$weight, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->marital_status==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'marital_status'=>$marital_status,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'marital_status'=>$marital_status,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->body_type==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'body_type'=>$body_type,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'body_type'=>$body_type,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->drink==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'drink'=>$drink,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'drink'=>$drink, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->smoke==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'smoke'=>$smoke,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'smoke'=>$smoke,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->diet==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'diet'=>$diet,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'diet'=>$diet,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->complexion==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'complexion'=>$complexion,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'complexion'=>$complexion,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mother_tongue==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mother_tongue'=>$mother_tongue,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'mother_tongue'=>$mother_tongue, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->beard==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'beard'=>$beard,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'beard'=>$beard, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }
      

      if($check_profile->mustache==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mustache'=>$mustache,
        'complete_status'=>$count, 
        'added_by'=>$created_by,
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'mustache'=>$mustache,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->appearance==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'appearance'=>$appearance,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'appearance'=>$appearance,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      
      return back()->with('success','About you information has been updated successfully!');

    }



    public function insertPreferenceForAdmin(Request $request, $id){
      
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



    public function createEducationForAdmin(Request $request, $id){
      
      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "profile-".Date('Ymdhis')."-".$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./profile/".$filename;

      
      $education = $request->get('txtEducation');
      $profile_status = $request->get('optStatus');
      $paid_status = 'Unpaid';
      $mobile_no = $request->get('txtMobileNo');
      $address = $request->get('txtAddress');
      $permanent_address = $request->get('txtPermanentAddress');
      $city = $request->get('txtCity');
      $country = $request->get('optCountryName');

      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->education==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'education'=>$education,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'education'=>$education, 
        'edited_by'=>Auth::user()->id
        ]);
      }


      if($check_profile->mobile_no==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'mobile_no'=>$mobile_no,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
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


      if($filetmp!=""):
      move_uploaded_file($filetmp, $filepath);
      $count = $count + 1;
      ProfileList::where('client_id', Auth::user()->id)->update([
          'photo'=>$filename,
          'complete_status'=>$count,
          'paid_status'=>$paid_status
      ]);
      else:
      ProfileList::where('client_id', Auth::user()->id)->update([
          'paid_status'=>$paid_status
      ]);
      endif;

      if($check_profile->address==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'address'=>$address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'address'=>$address, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->permanent_address==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'permanent_address'=>$permanent_address,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'permanent_address'=>$permanent_address, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->city==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'city'=>$city,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'city'=>$city, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      if($check_profile->country==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'country'=>$country,
        'complete_status'=>$count, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'country'=>$country, 
        'edited_by'=>Auth::user()->id
        ]);
      }

      
      return back()->with('success','You have finished your information successfully!');

    }

    
    public function showNewProfile(){
      $country_list = CountryLists::get();
      return view('user.new_profile',[
        'countryList'=>$country_list
      ]); 
    }


    public function insertNewProfile(Request $request){
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
        'added_by'=>Auth::user()->role->name 
      ]);

      return back()->with('success','New profile has been created successfully!');

    }


    public function showNewPost(Request $request){
      return view('user.new_post');
    }


    public function insertNewPost(Request $request){

      $category = $request->get('optCategories');
      $title = $request->get('txtTitle');
      $description = $request->get('txtDescription');

      $filetmp = $_FILES["files"]["tmp_name"];
      $filename = "post-".Date('Ymdhis')."-".$_FILES["files"]["name"];
      $filetype = $_FILES["files"]["type"];
      $filepath = "./postimages/".$filename;

      if(empty($filetmp)):
        Post::create([
        'category'=>$category,
        'title'=>$title,
        'description'=>$description,
        'added_by'=>Auth::user()->id
      ]);
      else:
      move_uploaded_file($filetmp, $filepath);

      Post::create([
        'category'=>$category,
        'title'=>$title,
        'description'=>$description,
        'images'=>$filename,
        'added_by'=>Auth::user()->id
      ]);
      endif;
      return back()->with('success', 'The post has been submitted successfully!');
    }

    public function showAllPosts(){
      $all_post = Post::get();
      return view('user.all_posts',[
        'allPost'=>$all_post
      ]);
    }


    public function deletePost($id){
      $post_for = Post::findOrFail($id);
      unlink("./postimages/".$post_for->images);
      $post_for->delete();
      return back()->with('warning', 'This post has been deleted successfully!');
    }


    public function showEditPost(Request $request, $id){
      $post_seek = Post::where('id', $id)->first();
      return view('user.edit_post',[
        'postSeek'=>$post_seek
      ]);
    }


    public function updateNewPost(Request $request, $id){

      $category = $request->get('optCategories');
      $title = $request->get('txtTitle');
      $description = $request->get('txtDescription');

      $filetmp = $_FILES["files"]["tmp_name"];
      $filename = "post-".Date('Ymdhis')."-".$_FILES["files"]["name"];
      $filetype = $_FILES["files"]["type"];
      $filepath = "./postimages/".$filename;

      if(empty($filetmp)):
        Post::where('id', $id)->update([
        'category'=>$category,
        'title'=>$title,
        'description'=>$description,
        'added_by'=>Auth::user()->id
      ]);
      else:
      $post_details = Post::where('id', $id)->first();
      unlink("./postimages/".$post_details->images);
      move_uploaded_file($filetmp, $filepath);
      Post::where('id', $id)->update([
        'category'=>$category,
        'title'=>$title,
        'description'=>$description,
        'images'=>$filename,
        'added_by'=>Auth::user()->id
      ]);
      endif;
      return back()->with('success', 'The post has been updated successfully!');
    }


    public function showNewLinks(){
      return view('user.new_links');
    }

    public function insertNewLinks(Request $request){

      $filetmp = $_FILES["flImageIcon"]["tmp_name"];
      $filename = "link-".Date('Ymdhis')."-".$_FILES["flImageIcon"]["name"];
      $filetype = $_FILES["flImageIcon"]["type"];
      $filepath = "./linkimages/".$filename;

      if(empty($filetmp)):
      LinkList::create([
        'design_icon'=>$request->get('txtDesignIcon'),
        'title'=>$request->get('txtTitle'),
        'url'=>$request->get('txtUrl'),
        'added_by'=>Auth::user()->id
      ]);
      else:
      move_uploaded_file($filetmp, $filepath);
      LinkList::create([
        'image_icon'=>$filename,
        'design_icon'=>$request->get('txtDesignIcon'),
        'title'=>$request->get('txtTitle'),
        'url'=>$request->get('txtUrl'),
        'added_by'=>Auth::user()->id
      ]);
      endif;

      return back()->with('success', 'This link has been saved successfully!');

    }


    public function showAllLinks(){
      $all_links = LinkList::get();
      return view('user.all_links',[
        'allLinks'=>$all_links
      ]);
    }


    public function deleteLink($id){
      $link_for = LinkList::findOrFail($id);
      unlink("./linkimages/".$link_for->image_icon);
      $link_for->delete();
      return back()->with('warning', 'This link has been deleted successfully!');
    }


    public function editLinks($id){
      $link_info = LinkList::where('id', $id)->first();
      return view('user.edit_links',[
        'linkInfo'=>$link_info
      ]);
    }


    public function updateNewLinks(Request $request, $id){

      $filetmp = $_FILES["flImageIcon"]["tmp_name"];
      $filename = "link-".Date('Ymdhis')."-".$_FILES["flImageIcon"]["name"];
      $filetype = $_FILES["flImageIcon"]["type"];
      $filepath = "./linkimages/".$filename;

      if(empty($filetmp)):
      LinkList::where('id', $id)->update([
        'design_icon'=>$request->get('txtDesignIcon'),
        'title'=>$request->get('txtTitle'),
        'url'=>$request->get('txtUrl'),
        'edited_by'=>Auth::user()->id
      ]);
      else:
      $link_img = LinkList::where('id', $id)->first();
      unlink("./linkimages/".$link_img->image_icon);
      move_uploaded_file($filetmp, $filepath);
      LinkList::where('id', $id)->update([
        'image_icon'=>$filename,
        'design_icon'=>$request->get('txtDesignIcon'),
        'title'=>$request->get('txtTitle'),
        'url'=>$request->get('txtUrl'),
        'edited_by'=>Auth::user()->id
      ]);
      endif;

      return back()->with('success', 'This link has been updated successfully!');

    }


    public function showClientPackages(){
      $client_packages = Packages::where('package_for', 'Client')->get();
      return view('user.client_packages',[
        'clientPackages'=>$client_packages
      ]);
    }

    public function showNewClPackage(){
      return view('user.new_client_package');
    }

    public function insertClientPackage(Request $request){
      Packages::create([
        'package_for'=>'Client',
        'name'=>$request->get('txtPackageName'),
        'validity_days'=>$request->get('txtValidityDays'),
        'limit_profiles'=>$request->get('txtLimitProfiles'),
        'price'=>$request->get('txtPrice'),
        'added_by'=>Auth::user()->id
      ]);
      return back()->with('success', 'Client package has been created successfully!');
    }


    public function deletePackageBy($id){
      $package = Packages::findOrFail($id);
      $package->delete();
      return back()->with('warning', 'Package has been deleted successfully!');
    }


    public function editPackageBy($id){
      $package = Packages::where('id',$id)->first();
      return view('user.edit_client_package',[
        'package'=>$package
      ]);
    }


    public function updatePackages(Request $request, $id){

      Packages::where('id', $id)->update([
        'name'=>$request->get('txtPackageName'),
        'validity_days'=>$request->get('txtValidityDays'),
        'limit_profiles'=>$request->get('txtLimitProfiles'),
        'price'=>$request->get('txtPrice'),
        'edited_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Package has been updated successfully!');
    }


    public function showAgentPackages(){
      $agent_packages = Packages::where('package_for', 'Agent')->get();
      return view('user.agent_packages',[
        'agentPackages'=>$agent_packages
      ]);
    }


    public function showNewAgentPackage(){
      return view('user.new_agent_package');
    }


    public function insertAgentPackage(Request $request){
      Packages::create([
        'package_for'=>'Agent',
        'name'=>$request->get('txtPackageName'),
        'validity_days'=>$request->get('txtValidityDays'),
        'limit_profiles'=>$request->get('txtLimitProfiles'),
        'price'=>$request->get('txtPrice'),
        'added_by'=>Auth::user()->id
      ]);
      return back()->with('success', 'Agent package has been created successfully!');
    }

    public function assignPackageForClient($id){
      $packages = Packages::where('package_for', 'Client')->get();
      $profile_info = ProfileList::where('id', $id)->first();
      return view('user.assign_package',[
        'packages'=>$packages,
        'profileInfo'=>$profile_info
      ]);
    }

    public function showPackInfoBy(Request $request){
      $pack_id = $request->get('packageId');
      $packages = Packages::where('id', $pack_id)->first();
      $today = date('Y-m-d');
      $expire_date = date('Y-m-d', strtotime($today.'+'.$packages->validity_days.' days'));
      return Response::json([
        'success'=>true,
        'packages'=>$packages,
        'expire_date'=>$expire_date
      ]);
    }


    public function insertAssign(Request $request, $type){

      PaymentsInfo::create([
      'profile_id'=>$request->get('hddProfileId'),
      'client_type'=>$type,
      'package_id'=>$request->get('optPackageName'),
      'payment_method'=>$request->get('optPaymentMethod'),
      'mobile_no'=>$request->get('txtMobileNo'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);
      
      $payment_info = PaymentsInfo::where([
        'profile_id'=>$request->get('hddProfileId'),
        'added_by'=>Auth::user()->id
      ])->orderBy('id', 'desc')->first();

      AssignPackage::create([
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
      
      return redirect()->route('admin/showUnpaidUsers')->with('success', 'Package has been assigned successfully!');

    }


    public function editAssignPackage($id){
      $profile_info = ProfileList::where([
        'id'=>$id
      ])->first();
      $packages = Packages::where('package_for', 'Client')->get();
      $assign_package = AssignPackage::where('profile_id', $id)->first();
      $payment_info = PaymentsInfo::where('id', $assign_package->payment_id)->first();
      return view('user.edit_assign_package',[
        'profileInfo'=>$profile_info,
        'packages'=>$packages,
        'assignPackage'=>$assign_package,
        'paymentInfo'=>$payment_info
      ]);
    }


    public function updateAssignPackage(Request $request, $id){

      $profile_id = $request->get('hddProfileId');
      $package_id = $request->get('optPackageName');
      $expire_date = $request->get('dtExpireDate');

      $assign_info = AssignPackage::where('id', $id)->first();

      PaymentsInfo::where('id', $assign_info->payment_id)->update([
      'profile_id'=>$profile_id,
      'package_id'=>$package_id,
      'payment_method'=>$request->get('optPaymentMethod'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);

      AssignPackage::where('id', $id)->update([
        'profile_id'=>$profile_id,
        'package_id'=>$package_id,
        'expire_date'=>$expire_date,
        'edited_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Package assign has been updated successfully!');
    }

    public function showAgentList(){
      $agent_list = AgentList::get();
      return view('user.agent_list',[
        'agentList'=>$agent_list
      ]);
    }


    public function showNewAgent(){
      return view('user.new_agent');
    }

    public function insertNewAgent(Request $request){

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

      if(empty($filetmp) && !empty($filectmp)):
        
      move_uploaded_file($filectmp, $filecpath);
      User::create([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email, 
      'password'=>$password
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::create([
      'client_id'=>$clients->id,
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'cover_photo'=>$filecname,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);

      elseif(!empty($filetmp) && empty($filectmp)):
        move_uploaded_file($filetmp, $filepath);
      User::create([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email, 
      'password'=>$password
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::create([
      'client_id'=>$clients->id,
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      elseif(!empty($filetmp) && !empty($filectmp)):
      
      move_uploaded_file($filetmp, $filepath);
      move_uploaded_file($filectmp, $filecpath);

      User::create([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email, 
      'password'=>$password
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::create([
      'client_id'=>$clients->id,
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'cover_photo'=>$filecname,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      else:
        User::create([
      'name'=>$full_name,
      'username'=>$username,
      'email'=>$email, 
      'password'=>$password
      ]);

      $clients = User::where([
        'username'=>$username,
        'email'=>$email
      ])->first();

      AgentList::create([
      'client_id'=>$clients->id,
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      endif;

      return back()->with('success', 'New Agent has been created successfully!');
    }

    public function editAgent($id){
      $agent_list = AgentList::where('id', $id)->first();
      return view('user.edit_agent',[
        'agentList'=>$agent_list
      ]);
    }

    public function updateAgent(Request $request, $id){
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

      $agent_images = AgentList::where('id', $id)->first();

      if(empty($filetmp) && !empty($filectmp)):
      
      unlink("./agentimages/".$agent_images->cover_photo);
      move_uploaded_file($filectmp, $filecpath);
      
      AgentList::where('id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'cover_photo'=>$filecname,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'edited_by'=>Auth::user()->id
      ]);

      elseif(!empty($filetmp) && empty($filectmp)):
      
      unlink("./agentimages/".$agent_images->icon);
      move_uploaded_file($filetmp, $filepath);
      
      AgentList::where('id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      elseif(!empty($filetmp) && !empty($filectmp)):
      
     // unlink("./agentimages/".$agent_images->icon);
      //unlink("./agentimages/".$agent_images->cover_photo);

      move_uploaded_file($filetmp, $filepath);
      move_uploaded_file($filectmp, $filecpath);
      
      AgentList::where('id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'icon'=>$filename,
      'cover_photo'=>$filecname,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      else:
      
      AgentList::where('id', $id)->update([
      'full_name'=>$full_name,
      'company_name'=>$company_name,
      'address'=>$address,
      'mobile_no'=>$mobile_no,
      'status'=>'Active',
      'paid_status'=>'Unpaid',
      'added_by'=>Auth::user()->id
      ]);
      endif;

      return back()->with('success', 'New Agent has been updated successfully!');
    }

    public function changeAgentStatus($id){
      $agent_status = AgentList::where('id', $id)->first();
      if($agent_status->status=="Active"):
        AgentList::where('id', $id)->update([
        'status'=>'Deactive',
        'edited_by'=>Auth::user()->id
        ]);
      else:
        AgentList::where('id', $id)->update([
        'status'=>'Active',
        'edited_by'=>Auth::user()->id
        ]);
      endif;
      return back();

    }

    public function showUnpaidAgent(){
      $unpaid_agent = AgentList::where('paid_status', 'Unpaid')->get();
      return view('user.unpaid_agent',[
        'unpaidAgent'=>$unpaid_agent
      ]);
    }

    public function agentView($id){
      $agent_list = AgentList::where('id', $id)->first();
      $packages = Packages::where('package_for', 'Agent')->get();
      return view('user.agent_view',[
        'agentList'=>$agent_list,
        'packages'=>$packages
      ]);
    }


    public function insertAssignForAgent(Request $request){
      
      PaymentsInfo::create([
      'profile_id'=>$request->get('hddProfileId'),
      'client_type'=>'Agent',
      'package_id'=>$request->get('optPackageName'),
      'payment_method'=>$request->get('optPaymentMethod'),
      'trans_id'=>$request->get('txtTransId'),
      'amount'=>$request->get('txtAmount'),
      'added_by'=>Auth::user()->id
      ]);
      
      $payment_info = PaymentsInfo::where([
        'profile_id'=>$request->get('hddProfileId'),
        'added_by'=>Auth::user()->id
      ])->orderBy('id', 'desc')->first();

      $check_package = AgentAssignPackages::where([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName')
      ])->first();
      if(empty($check_package)):
        AgentAssignPackages::create([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'payment_id'=>$payment_info->id,
        'added_by'=>Auth::user()->id
      ]);
      else:
      AgentAssignPackages::where([
      'profile_id'=>$request->get('hddProfileId'),
      'package_id'=>$request->get('optPackageName')
      ])->update([
      'profile_id'=>$request->get('hddProfileId'),
      'package_id'=>$request->get('optPackageName'),
      'expire_date'=>$request->get('dtExpireDate'),
      'payment_id'=>$payment_info->id,
      'edited_by'=>Auth::user()->id
      ]);
      endif;
      
      AgentList::where('id', $request->get('hddProfileId'))->update([
        'paid_status'=>'Paid',
        'edited_by'=>Auth::user()->id
      ]);
      
      return back()->with('success', 'Package has been assigned successfully!');

    }

    public function showPaidAgent(){
      $paid_agent = AgentList::where('paid_status', 'Paid')->get();
      return view('user.paid_agents',[
        'paidAgent'=>$paid_agent
      ]);
    }

    public function editAgentView($id){
      $agent_list = AgentList::where('id', $id)->first();
      $package_assign = AgentAssignPackages::where('profile_id', $id)->first();
      $packages = Packages::where('package_for', 'Agent')->get();
      return view('user.edit_agent_view',[
        'packageAssign'=>$package_assign,
        'agentList'=>$agent_list,
        'packages'=>$packages
      ]);
    }

    public function updateAgentAssign(Request $request, $id){
      
      AgentAssignPackages::where('id', $id)->update([
        'profile_id'=>$request->get('hddProfileId'),
        'package_id'=>$request->get('optPackageName'),
        'expire_date'=>$request->get('dtExpireDate'),
        'edited_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'This information has been updated successfully!');

    }

    public function showAgentExpInfo(){
      $expire_info = AgentAssignPackages::where('expire_date', '<', Date('Y-m-d'))->get();
      return view('user.agent_expire_info',[
        'expireInfo'=>$expire_info
      ]);
    }

    public function showNewUser(){
      return view('user.new_users');
    }

    public function insertNewUser(Request $request){

      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "user-".Date('Ymdhis').'-'.$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./image/".$filename;
      move_uploaded_file($filetmp, $filepath);
      User::create([
      'role_id'=>2,
      'name'=>$request->get('txtName'), 
      'username'=>$request->get('txtUsername'),
      'email'=>$request->get('txtEmail'), 
      'password'=>bcrypt($request->get('txtPassword')),
      'about'=>$request->get('txtAbout'),
      'image'=>$filename
      ]);

      return back()->with('success', 'New user has been created successfully!');
    }

    public function showAllNormalUsers(){
      
      $users_list = User::where('role_id', 2)->get();
      
      return view('user.users_list',[
        'usersList'=>$users_list
      ]);

    }


    public function deleteUsersList($id){
      $users_seek = User::findOrFail($id);
      unlink("./image/".$users_seek->image);
      $users_seek->delete();
      return back();
    }


    public function editUsersList($id){
      $user_list = User::where('id', $id)->first();
      return view('user.edit_new_users',[
        'userList'=>$user_list
      ]);
    }


    public function updateUsersList(Request $request, $id){
      
      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "user-".Date('Ymdhis').'-'.$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./image/".$filename;
      
      if(empty($filetmp)):
      
      User::where('id', $id)->update([
      'name'=>$request->get('txtName'), 
      'username'=>$request->get('txtUsername'),
      'email'=>$request->get('txtEmail'), 
      'about'=>$request->get('txtAbout'),
      ]);

      else:
      
      move_uploaded_file($filetmp, $filepath);
      
      User::where('id', $id)->update([
      'name'=>$request->get('txtName'), 
      'username'=>$request->get('txtUsername'),
      'email'=>$request->get('txtEmail'), 
      'about'=>$request->get('txtAbout'),
      'image'=>$filename
      ]);

      endif;
      
      return back()->with('success', 'This user has been updated successfully!'); 
    }


    public function changeActiveStatus($id){
      $profile = ProfileList::where('id', $id)
      ->first();
      $user = User::where('id', $profile->client_id)->first();
      if($user->active==1){
        User::where('id', $profile->client_id)->update([
          'active'=>0
        ]);
      }else{
        User::where('id', $profile->client_id)->update([
          'active'=>1
        ]);
      }
      return back();
    }


    public function showReceivePayment(){
      $payments_info = PaymentsInfo::where([
        'client_type'=>'Client',
      ])->orderBy('verified_by', 'asc')->get();
      $packages = Packages::where('package_for', 'Client')->get();
      return view('user.receive_payment',[
        'paymentsInfo'=>$payments_info,
        'packages'=>$packages
      ]);
    }


    public function verifyPayment($id){
      $payments_info = PaymentsInfo::where('id', $id)->first();
      $package = Packages::where('id', $payments_info->package_id)->first();
      $today = date('Y-m-d');
      $expire_date = date('Y-m-d', strtotime($today.'+'.$package->validity_days.' days'));
      $check_assign_package = AssignPackage::where('profile_id', $payments_info->profile_id)->first();
      if(empty($check_assign_package)){
        AssignPackage::create([
          'profile_id'=>$payments_info->profile_id,
          'package_id'=>$payments_info->package_id,
          'expire_date'=>$expire_date,
          'payment_id'=>$payments_info->id,
          'added_by'=>Auth::user()->id
        ]);
        PaymentsInfo::where('id', $id)->update([
          'verified_by'=>Auth::user()->id
        ]);
        ProfileList::where('id',$payments_info->profile_id)->update([
          'paid_status'=>'Paid'
        ]);
      }else{
        AssignPackage::where('profile_id',$payments_info->profile_id)->update([
          'profile_id'=>$payments_info->profile_id,
          'package_id'=>$payments_info->package_id,
          'expire_date'=>$expire_date,
          'payment_id'=>$payments_info->id,
          'edited_by'=>Auth::user()->id
        ]);
        PaymentsInfo::where('id', $id)->update([
          'verified_by'=>Auth::user()->id
        ]);
        ProfileList::where('id',$payments_info->profile_id)->update([
          'paid_status'=>'Paid'
        ]);
      }
      return back();
    }



    public function showPersonalInfoForAdmin($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.personal_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showFamilyInfoForAdmin(){
      $profile_info = ProfileList::where('id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.family_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showOccupationForAdmin(){
      $profile_info = ProfileList::where('id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.occupation',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }



    public function showAboutForAdmin(){
      $profile_info = ProfileList::where('id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.about',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showFinishForAdmin(){
      $profile_info = ProfileList::where('id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('user.profiles.finish',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showTeamMember(){
      $team_members = TeamMember::all();
      return view('user.team_member',[
        'teamMember'=>$team_members
      ]);
    }



    public function insertTeamMember(Request $request){

      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "member-".Date('Ymdhis').'-'.$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./teamphoto/".$filename;
      
      move_uploaded_file($filetmp, $filepath);

      TeamMember::create([
        'full_name'=>$request->get('txtFullName'),
        'designation'=>$request->get('txtDesignation'),
        'photo'=>$filename,
        'added_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'New team member has been added successfully!');

    }


    public function deleteTeamMember($id){

      $team_member = TeamMember::findOrFail($id);

      unlink("./teamphoto/".$team_member->photo);

      TeamMember::where('id', $id)->delete();

      return back()->with('success', 'Record deleted successfully!');
    }


    public function updateTeamMember(Request $request, $id){

      $filetmp = $_FILES["flUPhoto"]["tmp_name"];
      $filename = "member-".Date('Ymdhis').'-'.$_FILES["flUPhoto"]["name"];
      $filetype = $_FILES["flUPhoto"]["type"];
      $filepath = "./teamphoto/".$filename;

      if(!empty($filetmp)):

      $team_member = TeamMember::findOrFail($id);

      unlink("./teamphoto/".$team_member->photo);
      
      move_uploaded_file($filetmp, $filepath);

      TeamMember::where('id', $id)->update([
        'full_name'=>$request->get('UtxtFullName'),
        'designation'=>$request->get('UtxtDesignation'),
        'photo'=>$filename,
        'edited_by'=>Auth::user()->id
      ]);

    else:

      TeamMember::where('id', $id)->update([
        'full_name'=>$request->get('UtxtFullName'),
        'designation'=>$request->get('UtxtDesignation'),
        'edited_by'=>Auth::user()->id
      ]);

    endif;

      return back()->with('success', 'Record has been updated successfully!');

    }



    public function showCityForAdmin(Request $request){
      $country_name = $request->get('country');
      $country = CountryLists::where('name', $country_name)->first();
      $city_list = CityList::where('country_id', $country->id)->get();
      return Response::json([
        'success'=>true,
        'cityList'=>$city_list
      ]);
    }



    public function showAllUsersViewById($id){
      $profile_info = ProfileList::where('id',$id)->first();
      $complete_status = ProfileList::where('id', $id)->value("complete_status");
      if($complete_status>=37):
        $complete_percent = 100;
      else:
        $complete_percent = round((100 * $complete_status)/37);
      endif;
      return view('user.all_users_view',[
        'profileInfo'=>$profile_info,
        'completePercent'=>$complete_percent
      ]);
    }

}
