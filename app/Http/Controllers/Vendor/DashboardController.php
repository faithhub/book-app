<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Book;
use App\Models\Message;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.vendor');
    }

    public function index()
    {
        try {
            //code...
            $data['title'] = "Vendor Dashboard";
            $data['count_materials'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->count();
            return view('vendor.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }

    public function about()
    {
        try {
            //code...
            $data['title'] = "About Us";
            return view('vendor.dashboard.about', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }

    public function create(Request $request)
    {
        try {
            if ($_POST) {

                $rules = array(
                    'subject' => ['required', 'max:200'],
                    'content' => ['required'],
                );

                $fieldNames = array(
                    'subject' => "Message Subject",
                    'content' => "Message Content"
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                $data = $request->except('_token');

                //Send MAil
                Mail::to("support@gmail.com")
                    ->cc("amaofaith.o@gmail.com")
                    ->bcc("adebayooluwadara@gmail.com")
                    ->send(new SendMail($data));

                dd($data);
                //Save Message in Database
                Message::create($data);
                Session::flash('success', 'Message Sent Successfully');
                return redirect()->route('vendor.sent');
            }

            $data['title'] = "Vendor Create Message";
            $data['inbox_count'] = 0;
            $data['sent_count'] = Message::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
            return view('vendor.dashboard.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function sent()
    {
        try {
            $data['title'] = "Vendor Sent Messages";
            $data['inbox_count'] = 0;
            $data['sent_count'] = Message::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
            $data['messages'] = Message::where('vendor_id', Auth::guard('vendor')->user()->id)->orderBy('id', 'desc')->paginate(10);
            return view('vendor.dashboard.sent', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function inbox()
    {
        try {
            $data['title'] = "Vendor Inbox Messages";
            $data['sent_count'] = Message::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
            $data['inbox_count'] = 0;
            // $data['messages'] = Message::where('vendor_id', Auth::guard('vendor')->user()->id)->orderBy('id', 'desc')->paginate(10);
            return view('vendor.dashboard.inbox', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
}
