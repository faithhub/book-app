<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            // $total_point = Rate::where('vendor_id', Auth::guard('vendor')->user()->id)->sum('rate');
            // $total_count = Rate::where('vendor_id', Auth::guard('vendor')->user()->id)->count();
            // if($total_count > 0){
            //     $data['final_rate'] = round($total_point / $total_count, 0);
            // }
            // $data['count_materials'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->count();
            // $data['count_rented'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->sum('rent');
            // $data['count_sold'] =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->sum('sold');
            // $rented =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->where('rent', '!=', Null)->get();
            // $solds =  Book::where(['vendor_id' => Auth::guard('vendor')->user()->id])->where('sold', '!=', Null)->get();
            // $rented_1 = [];
            // $sold_1 = [];
            // $total_rent = 0;
            // $total_sold = 0;
            // foreach ($rented as $rent) {
            //     $get = $rent->rent * env('BOOKRENT');
            //     array_push($rented_1, $get);
            // }

            // foreach ($solds as $sold) {
            //     $get = $sold->sold * $sold->book_price;
            //     array_push($sold_1, $get);
            // }


            // foreach($rented_1 as $rent){
            //     $total_rent += $rent;
            // }

            // foreach($sold_1 as $sold){
            //     $total_sold += $sold;
            // }

            // $data['total_rent'] = $total_rent;
            // $data['total_sold'] = $total_sold;
            return view('admin.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
}
