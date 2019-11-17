<?php

namespace App\Http\Controllers\Client;

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
use App\Model\FavoriteList;
use App\Model\ProposalList;
use App\Model\Viewers;
use App\Model\Preferences;
use App\Model\Packages;
use App\Model\PaymentsInfo;
use App\Model\PackagesByAgent;
use App\Model\AssignPackageByAgent;
use App\Model\AssignPackage;
use App\Model\PaymentToAgent;
use App\Model\MessageList;
use App\Model\AdminMessage;
use Illuminate\Support\Facades\Validator as Validate;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
      
      $preferences = Preferences::where('client_id', Auth::user()->id)->first();
      
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();

      $male_profiles = "";
      
      $female_profiles = "";

      if(empty($preferences)):
        
        if($profile_info->sex==""){

            $male_profiles = ProfileList::where('sex', 'Male')->get();
            
            $female_profiles = ProfileList::where('sex', 'Female')->get();

        }else{

            if($profile_info->sex=="Male"){

                $female_profiles = ProfileList::where('sex', 'Female')->get();

            }else{

                $male_profiles = ProfileList::where('sex', 'Male')->get();

            }

        }

      else:

        if($profile_info->sex==""){

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'religion'=>$preferences->religion,
              'marital_status'=>$preferences->marital_status,
              'beard'=>$preferences->beard,
              'mustache'=>$preferences->mustache,
              'appearance'=>$preferences->appearance,
              'education'=>$preferences->education,
              'body_type'=>$preferences->body_type,
              'drink'=>$preferences->drink,
              'smoke'=>$preferences->smoke,
              'diet'=>$preferences->diet,
              'complexion'=>$preferences->complexion,
              'occupation'=>$preferences->occupation,
              'country'=>$preferences->country,
              'city'=>$preferences->city,
            ])->whereBetween('age', [$preferences->from_age,$preferences->to_age])->whereBetween('annual_income', [$preferences->from_annual_income,$preferences->to_annual_income])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'religion'=>$preferences->religion,
              'marital_status'=>$preferences->marital_status,
              'appearance'=>$preferences->appearance,
              'education'=>$preferences->education,
              'body_type'=>$preferences->body_type,
              'drink'=>$preferences->drink,
              'smoke'=>$preferences->smoke,
              'diet'=>$preferences->diet,
              'complexion'=>$preferences->complexion,
              'occupation'=>$preferences->occupation,
              'country'=>$preferences->country,
              'city'=>$preferences->city,
            ])->get();

        }else{

            if($profile_info->sex=="Male"){
                $female_profiles = ProfileList::where([
                'sex'=>'Female',
                'religion'=>$preferences->religion,
                'marital_status'=>$preferences->marital_status,
                'appearance'=>$preferences->appearance,
                'education'=>$preferences->education,
                'body_type'=>$preferences->body_type,
                'drink'=>$preferences->drink,
                'smoke'=>$preferences->smoke,
                'diet'=>$preferences->diet,
                'complexion'=>$preferences->complexion,
                'occupation'=>$preferences->occupation,
                'country'=>$preferences->country,
                'city'=>$preferences->city,
              ])->get();
            }else{
                $male_profiles = ProfileList::where([
                'sex'=>'Male',
                'religion'=>$preferences->religion,
                'marital_status'=>$preferences->marital_status,
                'beard'=>$preferences->beard,
                'mustache'=>$preferences->mustache,
                'appearance'=>$preferences->appearance,
                'education'=>$preferences->education,
                'body_type'=>$preferences->body_type,
                'drink'=>$preferences->drink,
                'smoke'=>$preferences->smoke,
                'diet'=>$preferences->diet,
                'complexion'=>$preferences->complexion,
                'occupation'=>$preferences->occupation,
                'country'=>$preferences->country,
                'city'=>$preferences->city,
              ])->whereBetween('age', [$preferences->from_age,$preferences->to_age])->whereBetween('annual_income', [$preferences->from_annual_income,$preferences->to_annual_income])->get();
            }

        }
      endif; 

      $from_age = '';
      $to_age = '';
      $marital_status = '';
      $religion = '';
      $photo = '';

    	return view('client.dashboard',[
        'profileInfo'=>$profile_info,
        'femaleProfiles'=>$female_profiles,
        'maleProfiles'=>$male_profiles,
        'fromAge'=>$from_age,
        'toAge'=>$to_age,
        'maritalStatus'=>$marital_status,
        'religion'=>$religion,
        'photo'=>$photo
      ]);

    }


    public function showSuggestionProfile($id){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();

      return view('client.suggestion_view',[
        'profileInfo'=>$profile_info,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package
      ]);
    }


    public function suggestionSearch(Request $request){

        $from_age       = $request->get('optFromAge');
        $to_age         = $request->get('optToAge');
        $marital_status = $request->get('optMaritalStatus');
        $religion       = $request->get('optReligion');
        $photo          = $request->get('optPhoto');

        $male_profiles = '';
        $female_profiles = '';

        $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();

        if(!empty($from_age) && !empty($to_age) && !empty($photo) ){

          if($photo=="All"){

            $male_profiles = ProfileList::where('sex', 'Male')->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where('sex', 'Female')->whereBetween('age', [$from_age, $to_age])->get();

          }elseif($photo=="With Photo"){
            
            $male_profiles = ProfileList::where('sex', 'Male')->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where('sex', 'Female')->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

          }else{

            $male_profiles = ProfileList::where('sex', 'Male')->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where('sex', 'Female')->where('photo', NULL)->whereBetween('age', [$from_age, $to_age])->get();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($marital_status) && !empty($photo)){

          if($photo=="All"){

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }elseif($photo=="With Photo"){
            
            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

          }else{

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($religion) && !empty($photo)){

          if($photo=="All"){

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }elseif($photo=="With Photo"){
            
            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

          }else{

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }

        }elseif(!empty($from_age) && !empty($to_age) && !empty($marital_status) && !empty($religion) && !empty($photo)){

          if($photo=="All"){

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }elseif($photo=="With Photo"){
            
            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status,
              'religion'=>$religion
            ])->where('photo','!=', NULL)->whereBetween('age', [$from_age, $to_age])->get();

          }else{

            $male_profiles = ProfileList::where([
              'sex'=>'Male',
              'marital_status'=>$marital_status,
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

            $female_profiles = ProfileList::where([
              'sex'=>'Female',
              'marital_status'=>$marital_status,
              'religion'=>$religion,
              'photo'=>NULL
            ])->whereBetween('age', [$from_age, $to_age])->get();

          }

        }

        return view('client.dashboard',[
          'profileInfo'=>$profile_info,
          'femaleProfiles'=>$female_profiles,
          'maleProfiles'=>$male_profiles,
          'fromAge'=>$from_age,
          'toAge'=>$to_age,
          'maritalStatus'=>$marital_status,
          'religion'=>$religion,
          'photo'=>$photo
        ]);

    }


    public function viewProfile(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $complete_status = ProfileList::where('client_id', Auth::user()->id)->value("complete_status");
      $complete_percent = round((100 * $complete_status)/37);
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();
      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      if($profile->added_by=="Agent"):
        $payments_info = PaymentToAgent::where([
        'profile_id'=>$profile->id
        ])->get();
        $packages = PackagesByAgent::where('package_for', 'Client')->get();
      else:
        $payments_info = PaymentsInfo::where([
        'client_type'=>'Client',
        'profile_id'=>$profile->id
        ])->get();
        $packages = Packages::where('package_for', 'Client')->get();
      endif;

      return view('client.profile_view',[
        'profileInfo'=>$profile_info,
        'completePercent'=>$complete_percent,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
        'paymentsInfo'=>$payments_info,
        'packages'=>$packages
      ]);
    }


    public function showClientProfile(){
    	$profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
    	return view('client.profile',[
    		'profileInfo'=>$profile_info,
    	]);
    }


    public function showPersonalInformation(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.personal_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showFamilyInformation(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.family_information',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showOccupation(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.occupation',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }



    public function showAbout(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.about',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showPreferences(){
      $profile_info = Preferences::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.preference',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function showFinish(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::get();
      return view('client.profiles.finish',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function createPersonal(Request $request){
      $full_name = $request->get('txtFullName');
      $date_of_birth = $request->get('txtDateOfBirth');
      $age = $request->get('txtAge');
      $religion = $request->get('optReligion');
      $sex = $request->get('optSex');
      $blood_group = $request->get('txtBloodGroup');
      $paid_status = 'Unpaid';

      $profile_info_client = ProfileList::where('client_id', Auth::user()->id)->first();

      $id = $profile_info_client->id;

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


    public function createFamily(Request $request){
      
      $fathers_name = $request->get('txtFathersName');
      $fathers_occupation = $request->get('txtFathersOccupation');
      $mothers_name = $request->get('txtMothersName');
      $mothers_occupation = $request->get('txtMothersOccupation');
      $siblings = $request->get('txtSiblings');
      $family_value = $request->get('optFamilyValues');
      $paid_status = 'Unpaid';

      $profile_info_client = ProfileList::where('client_id', Auth::user()->id)->first();

      $id = $profile_info_client->id;
      
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


    public function createOccupation(Request $request){
      
      $occupation = $request->get('txtOccupation');
      $income = $request->get('txtIncome');
      $paid_status = 'Unpaid';

      $profile_info_client = ProfileList::where('client_id', Auth::user()->id)->first();

      $id = $profile_info_client->id;
      
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


    public function createAbout(Request $request){
      
      $height = $request->get('optHeight');
      $height_numeric = $request->get('txtHeightNumeric');
      $weight = $request->get('txtWeight');
      $body_type = $request->get('optBodyType');
      $marital_status = $request->get('optMaritalStatus');
      $drink = $request->get('optDrink');
      $smoke = $request->get('optSmoke');
      $diet = $request->get('optDiet');
      $complexion = $request->get('optComplexion');
      $mother_tongue = $request->get('optMotherTongue');
      $beard = $request->get('optBeard');
      $mustache = $request->get('optMustache');
      $appearance = $request->get('optAppearance');
      $paid_status = 'Unpaid';
      $created_by = $request->get('optCreatedBy');

      $profile_info_client = ProfileList::where('client_id', Auth::user()->id)->first();

      $id = $profile_info_client->id;

      $check_profile = ProfileList::where('id', $id)->first();

      if($check_profile->height==""){
        $count = ProfileList::where('id', $id)->value("complete_status");
        $count = $count + 1;
        ProfileList::where('id', $id)->update([
        'height'=>$height,
        'height_numeric'=>$height_numeric,
        'complete_status'=>$count,
        'added_by'=>$created_by, 
        'edited_by'=>Auth::user()->id
        ]);
      }else{
        ProfileList::where('id', $id)->update([
        'height'=>$height,
        'height_numeric'=>$height_numeric,
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


    public function createEducation(Request $request){
      
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


      $profile_info_client = ProfileList::where('client_id', Auth::user()->id)->first();

      $id = $profile_info_client->id;
      
      
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


    public function showChangePasword(Request $request){

      return view('client.change_password');

    }


    public function updateInfoForClient(Request $request)
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


    public function showFollowers(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $followers = FavoriteList::where('fav_profile_id', $profile->id)->orderBy('id', 'desc')->get();
      $followers_counts = FavoriteList::where('fav_profile_id', $profile->id)->count();
      return view('client.followers',[
        'followers'=>$followers,
        'followersCounts'=>$followers_counts
      ]);
    }


    public function showFollowersView($id){
      $profile_info = ProfileList::where('id', $id)->first();

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      return view('client.followers_view',[
        'profileInfo'=>$profile_info,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }


    public function clientSendProposal(Request $request, $id){
        
      if(!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
          $ip = $_SERVER['REMOTE_ADDR'];
      }

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $check_proposal = ProposalList::where([
      'profile_id'=>$profile->id,
      'proposal_profile_id'=>$id
      ])->first();

      if(empty($check_proposal)):

      ProposalList::create([
      'profile_id'=>$profile->id,
      'proposal_profile_id'=>$id,
      'id_address'=>$ip,
      'status'=>'Proposal Send',
      'added_by'=>Auth::user()->id
      ]);

      return back()->with('success', 'Proposal has been sent successfully!');

      else:
      
      ProposalList::where([
      'profile_id'=>$profile->id,
      'proposal_profile_id'=>$id
      ])->update([
      'profile_id'=>$profile->id,
      'proposal_profile_id'=>$id,
      'id_address'=>$ip,
      'status'=>'Proposal Send',
      'edited_by'=>Auth::user()->id
      ]);

      return back()->with('warning', 'Proposal already sent. You can not sent it again!');

      endif;

    }


    public function showProposals(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $proposals = ProposalList::where('proposal_profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->orderBy('id', 'desc')->get();
      $proposals_counts = ProposalList::where('proposal_profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->count();
      return view('client.proposals',[
        'proposals'=>$proposals,
        'proposalsCounts'=>$proposals_counts
      ]);
    }

    public function showProposalsView($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();
      $proposal_list = ProposalList::where([
        'profile_id'=>$id,
        'status'=>'Proposal accepted'
      ])->first();
      return view('client.proposals_view',[
        'profileInfo'=>$profile_info,
        'proposalList'=>$proposal_list,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }


    public function acceptProposals($id){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      ProposalList::where([
      'profile_id'=>$id,
      'proposal_profile_id'=>$profile->id
      ])->update([
        'status'=>'Proposal accepted'
      ]);
      return back()->with('success', 'Proposal accepted!');
    }


    public function showFollowList(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $favorite_list = FavoriteList::where('profile_id', $profile->id)->get();
      $favorite_count = FavoriteList::where('profile_id', $profile->id)->count();
      return view('client.follow_list',[
        'favoriteList'=>$favorite_list,
        'followersCounts'=>$favorite_count
      ]);
    }


    public function showFollowListView($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();
      return view('client.follow_list_view',[
        'profileInfo'=>$profile_info,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }


    public function showSendProposals(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $proposals = ProposalList::where('profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->orderBy('id', 'desc')->get();
      $proposals_counts = ProposalList::where('profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->count();
      return view('client.send_proposals',[
        'proposals'=>$proposals,
        'proposalsCounts'=>$proposals_counts
      ]);
    }


    public function showSendProposalView($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();
      $status = ProposalList::where('proposal_profile_id', $id)->first();
      return view('client.send_proposals_view',[
        'profileInfo'=>$profile_info,
        'status'=>$status,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }


    public function showViewers(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $viewers = Viewers::where('profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->orderBy('id', 'desc')->get();
      $viewers_counts = Viewers::where('profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->count();
      return view('client.view_profiles',[
        'viewers'=>$viewers,
        'viewersCounts'=>$viewers_counts
      ]);
    }

    public function showViewProfileClient($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();
      return view('client.show_view_profile',[
        'profileInfo'=>$profile_info,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }

    public function showViewersList(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $viewers = Viewers::where('view_profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->orderBy('id', 'desc')->get();
      $viewers_counts = Viewers::where('view_profile_id', $profile->id)->where('profile_id', '!=', 'NULL')->count();
      return view('client.viewers_list',[
        'viewers'=>$viewers,
        'viewersCounts'=>$viewers_counts
      ]);
    }


    public function showViewersProfile($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $profile_info = ProfileList::where('id', $id)->first();
      return view('client.viewers_profile',[
        'profileInfo'=>$profile_info,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package
      ]);
    }


    public function showPreference(){
      $profile_info = Preferences::where('client_id', Auth::user()->id)->first();
      $country_list = CountryLists::all();
      return view('client.preferences',[
        'profileInfo'=>$profile_info,
        'countryList'=>$country_list
      ]);
    }


    public function insertPreference(Request $request){
      
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

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
        'from_height_numeric'=>$request->get('txtFromHeightNumeric'),
        'to_height'=>$request->get('txtToHeight'),
        'to_height_numeric'=>$request->get('txtToHeightNumeric'),
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
        'from_height_numeric'=>$request->get('txtFromHeightNumeric'),
        'to_height'=>$request->get('txtToHeight'),
        'to_height_numeric'=>$request->get('txtToHeightNumeric'),
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

    public function showPaymentDetails(){
      
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      
      if($profile->added_by=="Agent"):
        $payments_info = PaymentToAgent::where([
        'profile_id'=>$profile->id
        ])->get();
        $packages = PackagesByAgent::where('package_for', 'Client')->get();
      else:
        $payments_info = PaymentsInfo::where([
        'client_type'=>'Client',
        'profile_id'=>$profile->id
        ])->get();
        $packages = Packages::where('package_for', 'Client')->get();
      endif;
      
      return view('client.payments',[
        'paymentsInfo'=>$payments_info,
        'packages'=>$packages
      ]);
      
    }


    public function insertPaymentDetails(Request $request){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      if($profile->added_by=="Agent"):
        PaymentToAgent::create([
        'profile_id'=>$profile->id,
        'package_id'=>$request->get('optPackages'),
        'payment_method'=>$request->get('optPaymentMethod'),
        'mobile_no'=>$request->get('txtMobileNo'),
        'trans_id'=>$request->get('txtTransId'),
        'amount'=>$request->get('txtAmount'),
        'added_by'=>Auth::user()->id
      ]);
      else:
        PaymentsInfo::create([
        'profile_id'=>$profile->id,
        'client_type'=>'Client',
        'package_id'=>$request->get('optPackages'),
        'payment_method'=>$request->get('optPaymentMethod'),
        'mobile_no'=>$request->get('txtMobileNo'),
        'trans_id'=>$request->get('txtTransId'),
        'amount'=>$request->get('txtAmount'),
        'added_by'=>Auth::user()->id
      ]);
      endif;
      
      return back()->with('success', 'Payment has been sent successfully!');
    }


    public function showCityForClient(Request $request){
      $country_name = $request->get('country');
      $country = CountryLists::where('name', $country_name)->first();
      $city_list = CityList::where('country_id', $country->id)->get();
      return Response::json([
        'success'=>true,
        'cityList'=>$city_list
      ]);
    }


    public function sendMessageByClient(Request $request){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $title        = $request->get('txtTitle');
      $description  = $request->get('txtMessage');
      $receiver_profile_id = $request->get('txtReiverId');
      $sender_profile_id = $profile->id;
      MessageList::create([
        'sender_profile_id'=>$sender_profile_id,
        'receiver_profile_id'=>$receiver_profile_id,
        'title'=>$title,
        'description'=>$description,
        'status'=>'Sent',
        'added_by'=>Auth::user()->id
      ]);
      return back()->with('success', 'Your message has been sent successfully!');
    }


    public function showInbox(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $inbox_list = MessageList::where('receiver_profile_id', $profile->id)->where('title', '!=', 'Reply Message')->orderBy('id', 'desc')->get();
      $inbox_count = MessageList::where('receiver_profile_id', $profile->id)->where('title', '!=', 'Reply Message')->count();
      return view('client.inbox',[
        'inboxList'=>$inbox_list,
        'inboxCount'=>$inbox_count
      ]);
    }


    public function showIndexProfile($id){
      $profile_info = ProfileList::where('id', $id)->first();
      $proposal_list = ProposalList::where([
        'profile_id'=>$id,
        'status'=>'Proposal accepted'
      ])->first();
      return view('client.inbox_profile',[
        'profileInfo'=>$profile_info,

      ]);
    }


    public function showSentProfile($id){
      $profile_info = ProfileList::where('id', $id)->first();
      return view('client.sent_profile',[
        'profileInfo'=>$profile_info,

      ]);
    }


    public function showMessageList($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();
      
      $message_views = MessageList::where('id', $id)->first();
      $sender = MessageList::where([
        'receiver_profile_id'=>$message_views->sender_profile_id,
        'sender_profile_id'=>$message_views->receiver_profile_id,
        'title'=>'Reply Message'
      ])->get();

      $receiver = MessageList::where([
        'receiver_profile_id'=>$message_views->receiver_profile_id,
        'sender_profile_id'=>$message_views->sender_profile_id,
        'title'=>'Reply Message'
      ])->get();
      return view('client.message_view',[
        'messageView'=>$message_views,
        'sender'=>$sender,
        'receiver'=>$receiver,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }



    public function showSentMessageList($id){

      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      $assign_package = AssignPackage::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();

      $agent_assign_package = AssignPackageByAgent::where('profile_id', $profile->id)->where('expire_date', '>', Date('Y-m-d'))->first();
      
      $message_views = MessageList::where('id', $id)->first();
      $receiver = MessageList::where([
        'receiver_profile_id'=>$message_views->sender_profile_id,
        'sender_profile_id'=>$message_views->receiver_profile_id,
        'title'=>'Reply Message'
      ])->get();

      $sender = MessageList::where([
        'receiver_profile_id'=>$message_views->receiver_profile_id,
        'sender_profile_id'=>$message_views->sender_profile_id,
        'title'=>'Reply Message'
      ])->get();

      return view('client.sent_message_view',[
        'messageView'=>$message_views,
        'sender'=>$sender,
        'receiver'=>$receiver,
        'assignPackage'=>$assign_package,
        'agentAssignPk'=>$agent_assign_package,
      ]);
    }



    public function showSentMessage(){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $sent_messages =MessageList::where('sender_profile_id', $profile->id)->where('title', '!=', 'Reply Message')->orderBy('id', 'desc')->get();
      return view('client.sent_message',[
        'sentMessage'=>$sent_messages
      ]);
    }


    public function changePicture(Request $request){

      $filetmp = $_FILES["flPhoto"]["tmp_name"];
      $filename = "profile-".Date('Ymdhis')."-".$_FILES["flPhoto"]["name"];
      $filetype = $_FILES["flPhoto"]["type"];
      $filepath = "./profile/".$filename;

      $profile_id = $request->get('txtProfileId');

      $profile = ProfileList::where('id', $profile_id)->first();

      unlink("./profile/".$profile->photo);

      ProfileList::where('id', $profile_id)->update([
        'photo'=>$filename,
        'edited_by'=>Auth::user()->id
      ]);

      move_uploaded_file($filetmp, $filepath);

      return back();

    }


    public function clientPackageSelectByID(Request $request){
      
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();

      if($profile->added_by=="Agent"):

        $package_id = $request->get('package_id');
        $package_info = PackagesByAgent::where('id', $package_id)->first();
        return Response::json([
          'success'=>true,
          'packageInfo'=>$package_info
        ]);

      else:

        $package_id = $request->get('package_id');
        $package_info = Packages::where('id', $package_id)->first();
        return Response::json([
          'success'=>true,
          'packageInfo'=>$package_info
        ]);

      endif;
      
    }


    public function showAdminMessage(){
      $profile_info = ProfileList::where('client_id', Auth::user()->id)->first();
      $message_list = AdminMessage::where('profile_id', $profile_info->id)->get();
      return view('client.admin_message',[
        'messageList'=>$message_list,
        'profileInfo'=>$profile_info
      ]);
    }


    public function sendAdminMessage(Request $request){
      $profile = ProfileList::where('client_id', Auth::user()->id)->first();
      $title        = $request->get('txtTitle');
      $description  = $request->get('txtMessage');
      $sender_profile_id = $profile->id;
      AdminMessage::create([
        'profile_id'=>$sender_profile_id,
        'title'=>$title,
        'description'=>$description,
        'status'=>'Sent',
        'added_by'=>Auth::user()->id
      ]);
      return back()->with('success', 'Your message has been sent successfully!');
    }


}
