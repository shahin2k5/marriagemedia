<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use App\Model\CompanyInfo;
use App\Model\LinkList;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }


    public function showForgetPassword(){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        return view('auth.passwords.email',[
        'companyInfo'=>$company_info,
        'links'=>$links,
      ]);
    }

    public function showResetPassword(){
        $company_info = CompanyInfo::first();
        $links = LinkList::get();
        return view('auth.passwords.reset',[
        'companyInfo'=>$company_info,
        'links'=>$links,
      ]);
    }

}
