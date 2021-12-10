<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            return view('vendor.dashboard.index', $data);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
}
