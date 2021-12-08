<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'name' => ['required', 'max:255'],
                    'username' => ['required', 'unique:users'],
                    'email' => ['required', 'email', 'unique:users'],
                    'mobile' => ['required', 'min:11', 'max:11'],
                    'password' => ['required', 'min:8', 'confirmed'],
                    'gender' => ['required', 'max:255'],
                    'dob' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'name' => 'Full Name',
                    'email' => 'Email',
                    'username' => 'Username',
                    'mobile' => 'Mobile Number',
                    'password' => 'Password',
                    'password_confirmation' => 'Confirm Password',
                    'dob' => 'Date Of Birth',
                    'gender' => 'Gender',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('error', 'Error fill your data appropriately');
                    return back()->withErrors($validator)->withInput();
                }
                
                $data = array(
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                );

                User::create($data);
                Session::flash('success', 'Registered successfully');
                return redirect()->route('user.login');
            } else {
                $data['title'] = "User Registration Page";
                return view('user.auth.register', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function login(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'username' => ['required'],
                    'password' => ['required', 'min:8'],
                );

                $fieldNames = array(
                    'username' => 'Username',                    
                    'password' => 'Password',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('error', 'Error fill your data appropriately');
                    return back()->withErrors($validator)->withInput();
                }
                
                $data = array(
                    'username' => $request->username,
                    'password' => $request->password,
                );
                if(!Auth::attempt($data)){
                    Session::flash('error', 'Incorrect Credentials');
                    return back();
                }

                dd(Auth::user());

                // return redirect()->route('user.dashboard');

                Session::flash('success', 'Registered successfully');
                return route('user.login');
            } else {
                $data['title'] = "User Login Page";
                return view('user.auth.login', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function logout()
    {
        dd(Auth::user());
        if(Auth::user()) // this means that the admin was logged in.
        {
            dd(Auth::user());
            // Auth::guard('admin')->logout();
            // return redirect()->route('admin.login');
        }
        // Auth::logout();
        // return redirect()->route('user.login');
    }
}
