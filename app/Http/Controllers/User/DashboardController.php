<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }
    
    public function index(){
        $data['title'] = "User Dashboard";
        return view('user.dashboard.index', $data);
    }
}
