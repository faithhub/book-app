<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.vendor');
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
                    'bank' => ['required', 'max:255'],
                    'acc_number' => ['required', 'max:255'],
                    'acc_name' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'name' => 'Full Name',
                    'mobile' => 'Mobile Number',
                    'dob' => 'Date Of Birth',
                    'gender' => 'Gender',
                    'bank' => 'Bank',
                    'acc_number' => 'Account Number',
                    'acc_name' => 'Account Name',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('error', 'Error fill your data appropriately');
                    return back()->withErrors($validator)->withInput();
                }

                $vendor = Vendor::find(Auth::guard('vendor')->user()->id);
                $vendor->name = $request->name;
                $vendor->mobile = $request->mobile;
                $vendor->gender = $request->gender;
                $vendor->dob = $request->dob;
                $vendor->bank = $request->bank;
                $vendor->acc_number = $request->acc_number;
                $vendor->acc_name = $request->acc_name;
                $vendor->save();

                Session::flash('success', 'Profile  successfully');
                return back();
            }

            $data['title'] = "Vendor Profile";
            return view('vendor.settings.profile', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }

    public function change_password(Request $request)
    {
        try {
            if ($_POST) {
                $rules = array(
                    'old_password'     => 'required',
                    'new_password'  => ['required', 'min:8', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/'],
                    'confirm_new_password' => 'required'
                );

                $fieldNames = array(
                    'old_password'     => 'Current Password',
                    'new_password'  => 'New Password',
                    'confirm_new_password' => 'Confirm New Password'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    $request->session()->flash('warning', 'Password must 8 character long, maximum of 16 character, One English uppercase characters (A – Z), One English lowercase characters (a – z), One Base 10 digits (0 – 9) and One Non-alphanumeric (For example: !, $, #, or %)');
                    return back()->withErrors($validator);
                }

                $current_password = Auth::guard('vendor')->user()->password;
                if (!Hash::check($request->old_password, $current_password)) {
                    $request->session()->flash('warning', 'Password Wrong');
                    return back()->withErrors(['old_password' => 'Please enter correct current password']);
                }

                if ($request->new_password != $request->confirm_new_password) {
                    $request->session()->flash('warning', 'Password not set');
                    return back()->withErrors(['new_password' => 'The New password and Confirm password not match']);
                }

                $obj_user = Vendor::find(Auth::guard('vendor')->user()->id);
                $obj_user->password = Hash::make($request->new_password);
                $obj_user->save();
                $request->session()->flash('success', 'Password changed successfully');
                return \back();
            }

            $data['title'] = "Vendor Update Password";
            return view('vendor.settings.change-password', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
}
