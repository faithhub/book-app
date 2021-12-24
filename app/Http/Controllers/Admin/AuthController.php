<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

                if (!Auth::guard('admin')->attempt($credentials)) {
                    Session::flash('error', 'Credentials not matced in our records!');
                    return back();
                }

                // dd(Auth::guard('vendor'));
                Session::flash('success', 'Successfully Logged In');
                return redirect(RouteServiceProvider::ADMIN);
            }

            if (View::exists('admin.auth.login')) {
                $data['title'] =  "Admin Login Page";
                return view('admin.auth.login', $data);
            }
            abort(Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->user()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            Session::flash('success', 'Logged out successfully');
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin.login');
    }
}
