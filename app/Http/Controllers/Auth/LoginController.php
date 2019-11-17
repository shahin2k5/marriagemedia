<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Role;
use App\Model\ProfileList;
use App\Model\CompanyInfo;
use App\Model\SliderImages;
use App\Model\CountryLists;
use App\Model\PaymentStatus;
use App\Model\Post;
use App\Model\LinkList;
use App\Model\Packages;
use App\Model\AssignPackage;
use App\Model\AgentList;
use App\Model\AgentAssignPackages;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check() && Auth::user()->role->id==1){
            $this->redirectTo = route('admin.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id==3){
            $this->redirect()->route('agent.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id==4){
            $this->redirect()->route('client.dashboard');
        }else{
           $this->redirectTo = route('user.dashboard'); 
        }
        $this->middleware('guest')->except('logout');
    }


    public function createRegister(Request $request){
        $num1 = (int)$request->get('txtNum1');
        $num2 = (int)$request->get('txtNum2');
        $user_input = (int)$request->get('txtCapthca');
        $result = $num1 + $num2;
        if($user_input!=$result){
            return back()->with('warning', 'Wrong Captcha Entered!');
        }
        else{
        $fullname = $request->get('txtFullName');
        //$username = $request->get('txtUsername');
        $username   = 'user'.$request->get('txtMobileNo');
        $email = $request->get('txtEmail');
        $mobile_no = $request->get('txtMobileNo');
        $password = $request->get('txtPassword');
        $cpassword = $request->get('txtCPassword');
        $gender = $request->get('rdSex');
        $role = $request->get('optRole');
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
            'password'=>bcrypt($password),
            'active'=>$active
            ]);

            $user_info = User::where('username', $username)->orWhere('email', $email)->first();
        if($role==3):
            AgentList::create([
                'client_id'=>$user_info->id,
                'full_name'=>$fullname,
                'mobile_no'=>$mobile_no,
                'status'=>'Active',
                'paid_status'=>'Unpaid',
                'added_by'=>$user_info->id
            ]);
        endif;

        if($role==4):
           ProfileList::create([
                'client_id'=>$user_info->id,
                'full_name'=>$fullname,
                'sex'=>$gender,
                'mobile_no'=>$mobile_no,
                'paid_status'=>'Unpaid',
                'complete_status'=>4,
                'added_by'=>'Self'
            ]); 
        endif;

            
        }//End User Create

        Auth::login($user);
        if($role==3):
        $dashboard = 'agent.dashboard';
        endif;
        if($role==4):
        $dashboard = 'client.dashboard';
        endif;
        return redirect()->route($dashboard);
        //endif;
        }//password match end
      }//captcha match end
    }

    

    public function showlogin(){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        return view('auth.login', [
          'companyInfo'=>$company_info,
          'links'=>$links
        ]);
    }

    protected function credentials(Request $request)
        {
          if(is_numeric($request->get('email'))){
            return ['mobile_no'=>$request->get('email'),'password'=>$request->get('password'), 'active'=>1];
          }
          elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'active'=>1];
          }
          return ['username' => $request->get('email'), 'password'=>$request->get('password'), 'active'=>1];
        }
        
     
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('showlogin');
    }

}
