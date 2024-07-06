<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $input['email'])->first();

        if ($user && $user->is_active == 0) {
            return view('pages.welcome');
        }

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $roles = Auth()->user()->roles->pluck('name')->toArray();

            if (in_array("admin", $roles)) {
                 return redirect()->route('admin_dashboard');
            }

            if (in_array("client", $roles)) {
                return redirect()->route('home_client');
            }

            if (in_array("lawyer", $roles)) {
                return redirect()->route('home_lawyer');
            }
            if (in_array("translation_company", $roles)) {
                return redirect()->route('home_company');
            }

        }
        else {
            return redirect()->route('login')->with('error', __('message.message'));
        }
    }

}
