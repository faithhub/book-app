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

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest.vendor')->except('logout');
    }

    public function register(Request $request)
    {
        try {
            if ($_POST) {
                $rules = array(
                    'name' => ['required', 'max:255'],
                    'username' => ['required', 'unique:vendors'],
                    'email' => ['required', 'email', 'unique:vendors'],
                    'mobile' => ['required', 'min:11', 'max:11'],
                    'password' => ['required', 'min:8', 'confirmed'],
                    'gender' => ['required', 'max:255'],
                    'dob' => ['required', 'max:255'],
                    'bank' => ['required', 'max:255'],
                    'acc_number' => ['required', 'max:255'],
                    'acc_name' => ['required', 'max:255'],
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

                $data = array(
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'bank' => $request->bank,
                    'acc_number' => $request->acc_number,
                    'acc_name' => $request->acc_name,
                );

                Vendor::create($data);
                Session::flash('success', 'Registered successfully');
                return redirect()->route('vendor.login');
            }

            if (View::exists('vendor.auth.register')) {
                $data['title'] =  "Vendor Registration Page";
                return view('vendor.auth.register', $data);
            }
            abort(Response::HTTP_NOT_FOUND);
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


                $credentials = $request->except(['_token']);

                if (!Auth::guard('vendor')->attempt($credentials)) {
                    Session::flash('error', 'Credentials not matced in our records!');
                    return back();
                }

                // dd(Auth::guard('vendor'));
                Session::flash('success', 'Successfully Logged In');
                return redirect(RouteServiceProvider::VENDOR);
            }

            if (View::exists('vendor.auth.login')) {
                $data['title'] =  "Vendor Login Page";
                return view('vendor.auth.login', $data);
            }
            abort(Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('vendor')->user()) // this means that the admin was logged in.
        {
            Auth::guard('vendor')->logout();
            Session::flash('success', 'Logged out successfully');
            return redirect()->route('vendor.login');
        }
        return redirect()->route('vendor.login');
    }
}
