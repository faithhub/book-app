<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }


    public function profile(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'name' => ['required', 'max:255'],
                    'mobile' => ['required', 'min:11', 'max:11'],
                    'gender' => ['required', 'max:255'],
                    'dob' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'name' => 'Full Name',
                    'mobile' => 'Mobile Number',
                    'dob' => 'Date Of Birth',
                    'gender' => 'Gender',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('error', 'Error fill your data appropriately');
                    return back()->withErrors($validator)->withInput();
                }

                $admin = Admin::find(Auth::guard('admin')->user()->id);
                $admin->name = $request->name;
                $admin->mobile = $request->mobile;
                $admin->gender = $request->gender;
                $admin->dob = $request->dob;
                $admin->save();

                Session::flash('success', 'Profile  successfully');
                return back();
            } else {
                $data['title'] = "Admin Profile";
                return view('admin.settings.profile', $data);
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
                    'old_password'     => 'required',
                    'new_password'  => ['required', 'min:8', 'same:confirm_new_password', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/'],
                    'confirm_new_password' => 'required'
                );

                $fieldNames = array(
                    'old_password'     => 'Current Password',
                    'new_password'  => 'New Password',
                    'confirm_new_password' => 'Confirm New Password'
                );
                //dd($request);
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    $request->session()->flash('warning', 'Password must 8 character long, maximum of 16 character, One English uppercase characters (A – Z), One English lowercase characters (a – z), One Base 10 digits (0 – 9) and One Non-alphanumeric (For example: !, $, #, or %)');
                    return back()->withErrors($validator);
                }
                
                $current_password = Auth::guard('admin')->user()->password;
                if (!Hash::check($request->old_password, $current_password)) {
                    $request->session()->flash('warning', 'Password Wrong');
                    return back()->withErrors(['old_password' => 'Please enter correct current password']);
                }

                $obj_user = Admin::find(Auth::guard('admin')->user()->id);
                $obj_user->password = Hash::make($request->new_password);
                $obj_user->save();
                $request->session()->flash('success', 'Password changed successfully');
                return \back();

            } else {
                $data['title'] = "Admin Update Password";
                return view('admin.settings.change-password', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
}
