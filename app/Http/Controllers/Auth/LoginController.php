<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])) && Auth()->user()->is_active) {
            $roles = Auth()->user()->roles->pluck('name')->toArray();
            if (in_array("typingCenter", $roles) || in_array("legalConsultant", $roles) || in_array("lawyer", $roles)|| in_array("translator", $roles)) {

                return redirect()->route('dashboardLawyer');
            } else {
                if (in_array("admin", $roles)) {
                    return redirect()->route('dashboard');
                }

            }

        } else {
            return redirect()->route('login')->with('error',  __('message.message'));
        }
    }
}
