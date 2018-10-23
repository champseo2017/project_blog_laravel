<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;
use Validator;
use App\Model\admin\admin;


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
     protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function showLoginForm()
    {
        return view('admin.login');
    }

     public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

   protected function credentials(Request $request)
    {
        
        return ['email'=>$request->email,'password'=>$request->password,'status'=>1];
        
        return $request->only($this->username(), 'password');
    }


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        
    }
    protected function authenticated(Request $request, $user)
    {
    $request->session()->flash('success', 'You are logged in!');
    }
     public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
          return redirect()->route( 'admin.login' );
    }
    protected function sendFailedLoginResponse(Request $request)
    {
    throw ValidationException::withMessages([
        $this->username() => [trans('auth.password')],
         $this->username() => [trans('auth.email')],
    ]);
    }
    
    
    
}
