<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Response, Storage, DB;
use App\Role;
use App\User;
use App\Model\ProfileList;
use App\Model\CompanyInfo;
use App\Model\SliderImages;
use App\Model\CountryLists;
use App\Model\PaymentStatus;
use App\Model\Post;
use App\Model\Viewers;
use App\Model\LinkList;
use App\Model\Packages;
use App\Model\AssignPackage;
use App\Model\AgentList;
use App\Model\FavoriteList;
use App\Model\ProposalList;
use App\Model\TeamMember;
use App\Model\AgentAssignPackages;

class HomeController extends Controller
{
    public function showAboutUs(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'About Us')->first();
        $links = LinkList::get();
        $team_members = TeamMember::all();
        return view('website.about_us', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'teamMembers'=>$team_members
        ]);
    }

    public function showDashboard(){
        $company_info = CompanyInfo::first();
        $sliders = SliderImages::get();
        $welcome_slide = SliderImages::orderBy('id', 'desc')->first();
        $profile_list = ProfileList::where(
            'publish_status','Published')->where('profile_status', '!=', 'Private')->get();
        $success_post = Post::where('category', 'Our Success Story')->first();
        $links = LinkList::get();
        return view('website.home', [
          'companyInfo'=>$company_info,
          'sliders'=>$sliders,
          'welcomeSlide'=>$welcome_slide,
          'profileList'=>$profile_list,
          'successPost'=>$success_post,
          'links'=>$links
        ]);
    }

    public function showContact(){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        return view('website.contact_us', [
          'companyInfo'=>$company_info,
          'links'=>$links
        ]);
    }

    public function showPaymentMethod(){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        return view('website.payment_method', [
          'companyInfo'=>$company_info,
          'links'=>$links
        ]);
    }


    public function favoriteSomeone($id){

        if(Auth::check() && Auth::user()->role->id==4){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $profile = ProfileList::where('client_id', Auth::user()->id)->first();

        FavoriteList::create([
        'profile_id'=>$profile->id,
        'fav_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT'],
        'added_by'=>Auth::user()->id
        ]);

        }else{

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        FavoriteList::create([
        'fav_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT']
        ]);

        }
        return back();
    }

    public function sendProposal(Request $request, $id){

        if(Auth::check() && Auth::user()->role->id==4){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $profile = ProfileList::where('client_id', Auth::user()->id)->first();

        ProposalList::create([
        'profile_id'=>$profile->id,
        'proposal_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT'],
        'status'=>'Proposal Send',
        'added_by'=>Auth::user()->id
        ]);

        }else{

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        ProposalList::create([
        'proposal_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT'],
        'status'=>'Proposal Send'
        ]);

        }
        return back();

    }

    public function showPrivacyPolicy(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'Privacy Policy')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showTermsAndConditions(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'Terms and Conditions')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }

    
    public function showServices(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'Services')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showLiveHelp(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', '24x7 Live help')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showFeedback(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'Feedback')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showFAQs(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'FAQs')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showAgentMenu(){
        $company_info = CompanyInfo::first();
        $about_post = Post::where('category', 'Agent')->first();
        $links = LinkList::get();
        $agent_list = AgentList::get();
        return view('website.loop', [
          'companyInfo'=>$company_info,
          'aboutPost'=>$about_post,
          'links'=>$links,
          'agentList'=>$agent_list
        ]);
    }


    public function showProfileDetails($id){

      if(Auth::check() && Auth::user()->role->id==4){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $profile = ProfileList::where('client_id', Auth::user()->id)->first();

        Viewers::create([
        'profile_id'=>$profile->id,
        'view_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT'],
        'added_by'=>Auth::user()->id
        ]);

        }else{

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        Viewers::create([
        'view_profile_id'=>$id,
        'id_address'=>$ip,
        'browser'=>$_SERVER['HTTP_USER_AGENT']
        ]);

        }


      $profile_info = ProfileList::where('id', $id)->first();
      $company_info = CompanyInfo::first();
      $links = LinkList::get();

      return view('website.profile_details',[
        'companyInfo'=>$company_info,
        'profileInfo'=>$profile_info,
        'links'=>$links
      ]);

    }


    public function showAgentProfiles($id){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $agent_list = AgentList::where('id', $id)->first();
        $profile_list = ProfileList::where([
            'added_by'=>'Agent',
            'edited_by'=>$agent_list->id
        ])->paginate(20);
        return view('website.agent',[
        'companyInfo'=>$company_info,
        'agentList'=>$agent_list,
        'profileList'=>$profile_list,
        'links'=>$links
      ]);
    }


    public function showAdvanceSearch(Request $request){

    $looking_for = $request->get('optLookingFor');
    $from_age = $request->get('fromAge');
    $to_age = $request->get('toAge');
    $religion = $request->get('optReligion');
    $city = $request->get('optCity');

    if($looking_for!=""){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$looking_for
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($from_age!="" && $to_age!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published'
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $from_age!="" && $to_age!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$looking_for
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($religion!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $religion!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'religion'=>$religion,
            'sex'=>$looking_for
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($from_age!="" && $to_age!="" && $religion!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $from_age!="" && $to_age!="" && $religion!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'religion'=>$religion,
            'sex'=>$looking_for
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($city!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $city!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$looking_for,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $religion!="" && $city!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$looking_for,
            'religion'=>$religion,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }elseif ($looking_for!="" && $from_age!="" && $to_age!="" && $religion!="" && $city!="") {
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'religion'=>$religion,
            'sex'=>$looking_for,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
    }else{
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        $profile_list = ProfileList::where(
            'publish_status','Published')->where('profile_status', '!=', 'Private')->paginate(20);
        return view('website.advance_search',[
        'companyInfo'=>$company_info,
        'links'=>$links,
        'profileList'=>$profile_list
        ]);
      }
    }

    public function showByGender(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if($gender=="" && $from_age!="" && $to_age!=""){
        $profile_list = ProfileList::where('publish_status','Published')->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $from_height!="" && $to_height!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('height', [$from_height, $to_height])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published'
        ])->where('profile_status', '!=', 'Private')->where('marital_status', $marital)->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }


    public function showByAge(Request $request){
        $gender     = $request->get('gnd');
        $from_age   = $request->get('frmAge');
        $to_age     = $request->get('toAge');
        if($gender=="" && $from_age!="" && $to_age!=""){
        $profile_list = ProfileList::where('publish_status','Published')->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published'
        ])->where('profile_status', '!=', 'Private')->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }

    public function showByMarital(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->where('marital_status', $marital)->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published'
        ])->where('profile_status', '!=', 'Private')->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }



    public function showByReligion(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
        else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital
        ])->where('profile_status', '!=', 'Private')->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }


    public function showByEducation(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion!="" && $education!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'religion'=>$religion,
            'education'=>$education
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'education'=>$education
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion=="" && $education!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'education'=>$education
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
        else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }


    public function showByOccupation(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education!="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion!="" && $education!="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'religion'=>$religion,
            'education'=>$education,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education!="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education=="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion=="" && $education!="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }


    public function showByAnnualIncome(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion!="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'religion'=>$religion,
            'education'=>$education,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education=="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion=="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation!="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation=="" && $from_income!="" && $to_income!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else{
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }




    public function showByCity(Request $request){
        $gender       = $request->get('gnd');
        $from_age     = $request->get('frmAge');
        $to_age       = $request->get('toAge');
        $from_height  = $request->get('frmHeight');
        $to_height    = $request->get('toHeight');
        $marital      = $request->get('maritals');
        $religion     = $request->get('religions');
        $education    = $request->get('educations');
        $occupation   = $request->get('occupations');
        $from_income  = $request->get('fromIncome');
        $to_income    = $request->get('toIncome');
        $city         = $request->get('citys');
        if ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion!="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'religion'=>$religion,
            'education'=>$education,
            'religion'=>$religion,
            'education'=>$education,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'education'=>$education,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital=="" && $religion=="" && $education=="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion=="" && $education!="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'education'=>$education,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation!="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'occupation'=>$occupation,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation=="" && $from_income!="" && $to_income!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $marital!="" && $religion!="" && $education=="" && $occupation=="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($gender!="" && $from_age!="" && $to_age!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }elseif ($from_age!="" && $to_age!="" && $city!="") {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'city'=>$city
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }else {
        $profile_list = ProfileList::where([
            'publish_status'=>'Published',
            'sex'=>$gender,
            'marital_status'=>$marital,
            'religion'=>$religion
        ])->where('profile_status', '!=', 'Private')->whereBetween('age', [$from_age, $to_age])->whereBetween('annual_income', [$from_income, $to_income])->get();
        return Response::json(array(
            'success'=>true,
            'profileList'=>$profile_list
        ));
        }
    }

    
    public function showRegistration(Request $request){

        $fullname   = $request->get('txtFullName');
        $username   = 'user'.$request->get('txtMobileNo');
        $email      = $request->get('txtEmail');
        $mobile_no  = $request->get('txtMobileNo');
        $gender     = $request->get('optGender');
        $password   = $request->get('txtPassword');
        $cpassword  = $request->get('cpassword');
        $role = 4;
        $active = 1;

        if($cpassword != $password){
            return back()->with('warning', 'Password Missmatch');
        }
        else{

        $username_check = User::where('username', $username)->first();
        $email_check = User::where('email', $email)->first();
        $mobileNo_check = User::where('mobile_no', $mobile_no)->first();

        if($username_check!=""){
            return back()->with('warning', 'Username is already exist in database.');
        }elseif($email_check!=""){
            return back()->with('warning', 'Email is already exist in database.');
        }elseif($mobileNo_check!=""){
            return back()->with('warning', 'Mobile No is already exist in database.');
        }else{
            $user = User::create([
            'role_id'=>$role,
            'name'=>$fullname, 
            'username'=>$username,
            'email'=>$email, 
            'mobile_no'=>$mobile_no,
            'sex'=>$gender,
            'password'=>bcrypt($password),
            'active'=>$active
            ]);

            $user_info = User::where('username', $username)->orWhere('email', $email)->first();
        // if($role==3):
        //     AgentList::create([
        //         'client_id'=>$user_info->id,
        //         'full_name'=>$fullname,
        //         'mobile_no'=>$mobile_no,
        //         'status'=>'Active',
        //         'paid_status'=>'Unpaid',
        //         'added_by'=>$user_info->id
        //     ]);
        // endif;

        if($role==4):
           ProfileList::create([
                'client_id'=>$user_info->id,
                'full_name'=>$fullname,
                'mobile_no'=>$mobile_no,
                'paid_status'=>'Unpaid',
                'complete_status'=>4,
                'added_by'=>'Self'
            ]); 
        endif;

            
        }

        Auth::login($user);
        if($role==3):
        $dashboard = 'agent.dashboard';
        endif;
        if($role==4):
        $dashboard = 'client.dashboard';
        endif;
        return redirect()->route($dashboard);
        }//password match end

    }


}
