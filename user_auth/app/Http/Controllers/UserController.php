<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function index()
    {
        return view('registration');
    }
    public function userPostRegistration(Request $request)
    {

        $request->validate([
            'first_name'        =>      'required',
            'last_name'         =>      'required',
            'email'             =>      'required|email',
            'password'          =>      'required|min:6',
            'confirm_password'  =>      'required|same:password',
            'phone'             =>      'required|max:10'
        ]);

        $input          =           $request->all();

        $inputArray      =           array(
            'first_name'        =>      $request->first_name,
            'last_name'         =>      $request->last_name,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
            'phone'             =>      $request->phone
        );

        $user           =           User::create($inputArray);

        if (!is_null($user)) {
            return back()->with('success', 'You have registered successfully.');
        }

        else {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
    }

    public function userLoginIndex()
    {
        return view('login');
    }

    public function userPostLogin(Request $request)
    {

        $request->validate([
            "email"           =>    "required|email",
            "password"        =>    "required|min:6"
        ]);

        $userCredentials = $request->only('email', 'password');

        if (Auth::attempt($userCredentials)) {
            return view('dashboard');
        } else {
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }

    public function dashboard()
    {

        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect::to("user-login")->withSuccess('Oopps! You do not have access');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return view('login');
    }
}
