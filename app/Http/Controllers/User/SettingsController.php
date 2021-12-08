<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function profile()
    {
        $data['title'] = "User Profile";
        return view('user.settings.profile', $data);
    }

    public function edit_profile(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'name' => ['required', 'max:255'],
                    'mobile' => ['required', 'min:11', 'max:11'],
                    'password' => ['required', 'min:8', 'confirmed'],
                    'gender' => ['required', 'max:255'],
                    'dob' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'name' => 'Full Name',
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
                $data['title'] = "User Edit Profile";
                return view('user.settings.edit-profile', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function change_password(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'name' => ['required', 'max:255'],
                    'mobile' => ['required', 'min:11', 'max:11'],
                    'password' => ['required', 'min:8', 'confirmed'],
                    'gender' => ['required', 'max:255'],
                    'dob' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'name' => 'Full Name',
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
                $data['title'] = "User Edit Profile";
                return view('user.settings.change-password', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
}
