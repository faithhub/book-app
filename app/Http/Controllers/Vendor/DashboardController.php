<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        if (View::exists('vendor.dashboard.index')) {
            $data['title'] = "Vendor Dashboard";
            return view('vendor.dashboard.index', $data);
        }
        abort(Response::HTTP_NOT_FOUND);
    }
}
