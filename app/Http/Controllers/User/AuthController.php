<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BoughtBook;
use App\Models\Cart;
use App\Models\RentedBook;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest.user')->except('logout');
    }

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
                if (!Auth::attempt($data)) {
                    Session::flash('error', 'Incorrect Credentials');
                    return back();
                }

                $boughts = BoughtBook::where('user_id', Auth::user()->id)->get();
                $rents = RentedBook::where('user_id', Auth::user()->id)->get();
                foreach ($rents as $rent) {
                    if (Carbon::now() > $rent->return_time) {
                        dd(Carbon::now(), $rent->return_time);
                        $rent->delete();
                    }
                }
                $boughts_books = [];
                $rented_books = [];
                foreach ($rents as $rent) {
                    array_push($rented_books, $rent->book_id);
                }
                foreach ($boughts as $bought) {
                    array_push($boughts_books, $bought->book_id);
                }
                Session::put('boughts_books', $boughts_books ?? [0]);
                Session::put('rented_books', $rented_books ?? [0]);


                $carts = Cart::where('user_id', Auth::user()->id)->with('book')->get();
                $cart_count = $carts->count();
                $user_carts = [];
                foreach ($carts as $cart) {
                    array_push($user_carts, $cart->book_id);
                }
                Session::put('user_carts', $user_carts ?? [0]);
                Session::put('my_carts', $carts);
                Session::put('my_cart_count', $cart_count);


                Session::flash('success', 'Login successfully');

                return redirect()->route('user.dashboard');
            } else {
                $data['title'] = "User Login Page";
                return view('user.auth.login', $data);
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            Auth::logoutCurrentDevice();
            Session::forget('user_carts');
            Session::flash('success', 'Logged out successfully');
            return redirect()->route('user.login');
        }
    }
}
