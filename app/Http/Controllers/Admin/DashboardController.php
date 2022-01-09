<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Admin;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\Country;
use App\Models\Message;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        try {
            //code...
            $data['title'] = "Admin Dashboard";
            $data['vendor_count'] = Vendor::count();
            $data['user_count'] = User::count();
            $data['admin_count'] = Admin::count();
            $data['all_books'] =  Book::count();
            $data['count_rented'] =  Book::sum('rent');
            $data['count_sold'] =  Book::sum('sold');
            $rented =  Book::where('rent', '!=', Null)->get();
            $solds =  Book::where('sold', '!=', Null)->get();
            $rented_1 = [];
            $sold_1 = [];
            $total_rent = 0;
            $total_sold = 0;
            foreach ($rented as $rent) {
                $get = $rent->rent * env('BOOKRENT');
                array_push($rented_1, $get);
            }

            foreach ($solds as $sold) {
                $get = $sold->sold * $sold->book_price;
                array_push($sold_1, $get);
            }


            foreach ($rented_1 as $rent) {
                $total_rent += $rent;
            }

            foreach ($sold_1 as $sold) {
                $total_sold += $sold;
            }

            $data['total_rent'] = $total_rent;
            $data['total_sold'] = $total_sold;
            return view('admin.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function vendors()
    {
        try {
            //code...
            $data['title'] = "All Vendors";
            $data['sn'] = 1;
            $data['vendors'] = Vendor::orderBy('id', 'desc')->paginate(15);
            return view('admin.dashboard.vendors', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function users()
    {
        try {
            //code...
            $data['title'] = "All Users";
            $data['sn'] = 1;
            $data['users'] = User::orderBy('id', 'desc')->paginate(15);
            return view('admin.dashboard.users', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function about()
    {
        try {
            //code...
            $data['title'] = "About Us";
            $data['sn'] = 1;
            $data['about'] = Setting::first();
            return view('admin.dashboard.about', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function edit_about(Request $request)
    {
        try {
            $data['about'] = Setting::first();
            if ($_POST) {

                $rules = array(
                    'about' => 'required',
                );

                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $request->session()->flash('warning', 'About Us content is required');
                    return back()->withErrors($validator);
                }

                $get_settings = Setting::first();
                if ($get_settings) {
                    # code...
                    $get_settings->about = $request->about;
                    $get_settings->save();
                    Session::flash('success', 'About Us updated successfully');
                    return redirect()->route('admin.about');
                }

                Setting::create([
                    'about' => $request->about
                ]);
                Session::flash('success', 'About Us updated successfully');
                return redirect()->route('admin.about');
            }

            $data['title'] = "Edit About Us";
            return view('admin.dashboard.edit-about', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function policy()
    {
        try {
            $data['policy'] = Setting::first();
            $data['title'] = "Policy";
            return view('admin.dashboard.policy', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function edit_policy(Request $request)
    {
        try {
            $data['policy'] = Setting::first();
            if ($_POST) {

                $rules = array(
                    'policy' => 'required',
                );

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $request->session()->flash('warning', 'Policy content is required');
                    return back()->withErrors($validator);
                }

                $get_settings = Setting::first();
                if ($get_settings) {
                    # code...
                    $get_settings->policy = $request->policy;
                    $get_settings->save();
                    Session::flash('success', 'Policy updated successfully');
                    return redirect()->route('admin.policy');
                }

                Setting::create([
                    'policy' => $request->policy
                ]);
                Session::flash('success', 'Policy updated successfully');
                return redirect()->route('admin.policy');
            }
            //code...
            $data['title'] = "Edit Policy";
            return view('admin.dashboard.edit-policy', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function create(Request $request)
    {
        try {
            $data['vendors'] = Vendor::orderBy('id', 'desc')->get(['name', 'email', 'username', 'id']);
            if ($_POST) {

                $rules = array(
                    'vendor_id' => ['required', 'max:200'],
                    'subject' => ['required', 'max:200'],
                    'content' => ['required'],
                );

                $fieldNames = array(
                    'vendor_id' => "Vendor Name",
                    'subject' => "Message Subject",
                    'content' => "Message Content"
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                $vendor = Vendor::find($request->vendor_id);
                $data = [
                    "vendor_id" => $vendor->id,
                    "sender" => "Admin",
                    "subject" => $request->subject,
                    "content" => $request->content
                ];

                //dd($data);

                //Send MAil
                Mail::to($vendor->email)
                    ->cc(env("MAIL_CC"))
                    ->bcc(env("MAIL_BC"))
                    ->send(new SendMail($data));

                //Save Message in Database
                Message::create($data);
                Session::flash('success', 'Message Sent Successfully');
                return redirect()->route('admin.sent');
            }

            $data['title'] = "Admin Create Message";
            $data['inbox_count'] =  Message::where('sender', "Vendor")->count();;
            $data['sent_count'] = Message::where('sender', "Admin")->count();
            return view('admin.inbox.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function sent()
    {
        try {
            $data['sn'] = 1;
            $data['title'] = "Admin Sent Messages";
            $data['inbox_count'] =  Message::where('sender', "Vendor")->count();;
            $data['sent_count'] = Message::where('sender', "Admin")->count();
            $data['messages'] = Message::where('sender', "Admin")->with('vendor:id,name,email,username')->orderBy('id', 'desc')->get();
            return view('admin.inbox.sent', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function inbox()
    {
        try {
            $data['sn'] = 1;
            $data['title'] = "Admin Inbox Messages";
            $data['sent_count'] =  Message::where('sender', "Admin")->count();;
            $data['inbox_count'] =  Message::where('sender', "Vendor")->count();;
            $data['messages'] = Message::where('sender', "Vendor")->with('vendor:id,name,email,username')->orderBy('id', 'desc')->get();
            return view('admin.inbox.inbox', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }

    public function materials(){
        try {
            $data['title'] = "All Materials";
            $data['books'] = $b = Book::with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->paginate(15);
            return view('admin.books.my-books', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
    public function view_material($id)
    {
        try {
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('admin.books.view-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
    public function access($name, $id)
    {
        try {
            $my_book = Book::where(['id' => $id])->first();
            if ($my_book == null) {
                Session::flash('warning', 'Unable to access this material');
                return back();
            }
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            if ($b->material->name == "Videos") {
                $data['material_type'] = 'Video';
                $data['material'] = $d = asset('VIDEOMAT/' . $b->book_material_video);
            } else {
                $data['material_type'] = 'PDF';
                $data['material'] = $d = asset('MATERIALPPDF/' . $b->book_material_pdf);
            }
            $data['title'] = $b->book_name;
            return view('admin.books.access', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
}
