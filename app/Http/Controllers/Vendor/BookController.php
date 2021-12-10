<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.vendor');
    }

    public function my_books()
    {
        try {
            if (View::exists('vendor.books.my-books')) {
                $data['title'] = "Vendor My Books";
                return view('vendor.books.my-books', $data);
            }

            abort(Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function upload_new_book(Request $request)
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

                $user = Vendor::find(Auth::guard('vendor')->user()->id);
                $user->name = $request->name;
                $user->mobile = $request->mobile;
                $user->gender = $request->gender;
                $user->dob = $request->dob;
                $user->bank = $request->bank;
                $user->acc_number = $request->acc_number;
                $user->acc_name = $request->acc_name;
                $user->save();

                Session::flash('success', 'Profile  successfully');
                return back();
            }

            $data['title'] = "Vendor Upload New Book";
            return view('vendor.books.upload-new-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
}
