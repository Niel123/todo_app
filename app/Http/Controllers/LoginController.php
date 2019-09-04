<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
        
    }
    
    public function checkLogin(Request $request)
    {
          // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'/*|min:6*/
        ]);
          // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            $user =  User::where('email', $request->email)->first();
            session()->put('islogin', true);
            return redirect()->intended(route('home'));
            
        }else{
            Session::flash('error_credential', 'Invalid email/password!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }

    }

   
}