<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Book;
use App\Models\Message;
use App\Models\Rate;
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
            $total_point = Rate::where('vendor_id', Auth::guard('vendor')->user()->id)->sum('rate');
            $total_count = Rate::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
            if($total_count > 0){
                $data['final_rate'] = round($total_point / $total_count, 0);
            }
            $data['count_materials'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->count();
            $data['count_rented'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->sum('rent');
            $data['count_sold'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->sum('sold');
            $rented =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->where('rent', '!=', Null)->get();
            $solds =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->where('sold', '!=', Null)->get();
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


            foreach($rented_1 as $rent){
                $total_rent += $rent;
            }

            foreach($sold_1 as $sold){
                $total_sold += $sold;
            }

            $data['total_rent'] = $total_rent;
            $data['total_sold'] = $total_sold;
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
