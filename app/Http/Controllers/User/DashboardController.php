<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }


    public function index()
    {
        try {
            //code...
            $data['books'] = $b = Book::with('material')->orderBy('id', 'asc')->get()->groupBy('material.name');
            $data['books2'] = Book::orderBy('id', 'asc')->get();
            $data['mats'] = BookMaterial::orderBy('name', 'asc')->get();
            //dd($b);
            $data['title'] = "User Dashboard";
            return view('user.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function view_book($id){
        
        try {
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('user.dashboard.view-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }
    public function material($id){
        
        try {
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('user.dashboard.view-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }
}
