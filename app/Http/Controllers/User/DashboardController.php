<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\BoughtBook;
use App\Models\Cart;
use App\Models\Country;
use App\Models\RentedBook;
use App\Models\Transaction;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
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
            $data['title'] = "User Dashboard";
            return view('user.dashboard.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function view_book($name, $id)
    {

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
    public function material($name, $id)
    {
        try {
            $data['mat'] = $mat = BookMaterial::where('id', $id)->first();
            $data['books'] = $b = Book::where(['book_material_type' => $mat->id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'desc')->paginate(12);
            $data['title'] = $mat->name;
            return view('user.dashboard.material', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function bought_books()
    {
        try {
            $data['books'] = $b = BoughtBook::where('user_id', Auth::user()->id)->with('book')->paginate(15);
            $data['title'] = "Bought Books";
            return view('user.dashboard.bought', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function rent_books()
    {
        try {
            $data['books'] = $b = RentedBook::where('user_id', Auth::user()->id)->with('book')->paginate(15);
            $data['title'] = "rent Books";
            return view('user.dashboard.rent', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function add_cart(Request $request)
    {
        try {
            $data = array(
                'user_id' => Auth::user()->id,
                'book_id' => $request->book_id
            );
            Cart::create($data);

            $carts = Cart::where('user_id', Auth::user()->id)->with('book')->get();

            $boughts = BoughtBook::where('user_id', Auth::user()->id)->get();
            $rents = RentedBook::where('user_id', Auth::user()->id)->get();
            foreach ($rents as $rent) {
                if ($rent->return_time > Carbon::now()) {
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

            $cart_count = $carts->count();
            $user_carts = [];
            foreach ($carts as $cart) {
                array_push($user_carts, $cart->book_id);
            }
            Session::put('user_carts', $user_carts ?? [0]);
            Session::put('my_carts', $carts);
            Session::put('my_cart_count', $cart_count);

            Session::flash('success', 'Book added to cart');
            return back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
    public function remove_cart(Request $request)
    {
        try {
            Cart::where(['user_id' => Auth::user()->id, 'book_id' => $request->book_id])->delete();
            $carts = Cart::where('user_id', Auth::user()->id)->with('book')->get();
            $cart_count = $carts->count();
            $user_carts = [];
            foreach ($carts as $cart) {
                array_push($user_carts, $cart->book_id);
            }
            Session::put('user_carts', $user_carts ?? [0]);
            Session::put('my_carts', $carts);
            Session::put('my_cart_count', $cart_count);
            Session::flash('success', 'Book removed to cart');
            return back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function checkout(Request $request)
    {
        try {
            //code...
            $data['title'] = "Checkout";
            $data['all_carts'] = Cart::where('user_id', Auth::user()->id)->with('book')->get();
            // $data['total'] = Cart::where('user_id', Auth::user()->id)->with('book')->get();
            return view('user.dashboard.checkout', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function payment_history()
    {
        try {
            //code...
            $data['title'] = "Transactions";
            $data['sn'] = 1;
            $data['transactions'] = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
            // $data['total'] = Cart::where('user_id', Auth::user()->id)->with('book')->get();
            return view('user.dashboard.payment-history', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }


    public function search(Request $request)
    {
        try {
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['title'] = "Search Result Page";
            $data['result'] = "No result found";
            if ($_POST) {
                if ($request->book_name == null && $request->book_author == null && $request->book_material_type == null && $request->book_cat == null && $request->book_paid_free == null) {
                    return view('user.dashboard.search', $data);
                }

                $data['books'] = $b = Book::where('book_name', 'LIKE', '%' . $request->book_name . '%')
                    // ->orwhere('book_author', 'LIKE', '%' . $request->book_author . '%')
                    // ->orwhere('book_material_type', 'LIKE', '%' . $request->book_material_type . '%')
                    // ->orwhere('book_cat', 'LIKE', '%' . $request->book_cat . '%')
                    // ->orwhere('book_country', 'LIKE', '%' . $request->book_country . '%')
                    // ->orwhere('book_paid_free', 'LIKE', '%' . $request->book_paid_free . '%')
                    // ->orwhere('book_tag', 'LIKE', '%' . $request->book_tag . '%')
                    ->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'desc')->paginate(12);
                //dd($b);
                return view('user.dashboard.search', $data);
            }
            return view('user.dashboard.search', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function access_book($name, $id)
    {
        try {
            $rent = RentedBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();
            $bought = BoughtBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();
            if ($rent == null & $bought == null) {
                Session::flash('warning', 'You do not have permision to access this material');
                return back();
            }
            if ($rent != null) {
                if ($rent->return_time > Carbon::now()) {
                    $rent->delete();
                    Session::flash('warning', 'Rent period for this material has expired, you do not have permision to access this material');
                    return route('user.dashboard');
                }
            }
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            if ($b->material->name == "Videos") {
                $data['material_type'] = 'Video';
                $data['material'] = $d = asset('VIDEOMAT/' . $b->book_material_video);
            } else {
                $data['material_type'] = 'PDF';
                $data['material'] = $d = asset('MATERIALPPDF/' . $b->book_material_pdf);
            }
            //dd($d);
            $data['material_type'] = 'Video';
            $data['title'] = $b->book_name;
            return view('user.dashboard.access-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function save_payment(Request $request)
    {
        $rate_data = [];
        function book_data()
        {
            $boughts = BoughtBook::where('user_id', Auth::user()->id)->get();
            $rents = RentedBook::where('user_id', Auth::user()->id)->get();
            foreach ($rents as $rent) {
                if ($rent->return_time > Carbon::now()) {
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
        }

        $data = array(
            'user_id' => Auth::user()->id,
            'ref' => $request->ref,
            'amount' => $request->amount
        );
        //return $data;
        if ($request->type == "Buy") {
            BoughtBook::create([
                'user_id' => Auth::user()->id,
                'book_id' => $request->book_id
            ]);
            $book = Book::where('id', $request->book_id)->first();
            $book->sold = $book->sold + 1;
            $book->save();
            Cart::where(['user_id' => Auth::user()->id, 'book_id' => $request->book_id])->delete();
            book_data();
            Transaction::create($data);
            return true;
        }

        if ($request->type == "Rent") {
            $data2 = [
                'user_id' => Auth::user()->id,
                'book_id' => $request->book_id,
                'time_borroewd' => Carbon::now(),
                'return_time' => Carbon::now()->add(1, 'day')
            ];
            RentedBook::create($data2);
            $book = Book::where('id', $request->book_id)->first();
            $book->rent = $book->rent + 1;
            $book->save();
            Cart::where(['user_id' => Auth::user()->id, 'book_id' => $request->book_id])->delete();
            book_data();
            Transaction::create($data);
            return true;
        }
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            BoughtBook::create([
                'user_id' => Auth::user()->id,
                'book_id' => $cart->book_id
            ]);
            $book = Book::where('id', $cart->book_id)->first();
            $book->sold = $book->sold + 1;
            $book->save();
            array_push($rate_data, $cart->book_id);
        }
        book_data();
        Transaction::create($data);
        Cart::where('user_id', Auth::user()->id)->delete();
        Session::forget('my_cart_count');
        Session::forget('user_carts');
        Session::forget('my_carts');
        Session::put('user_carts', $user_carts ?? [0]);
        Session::put('rate_data', $rate_data ?? [0]);

        return true;
    }

    public function rate(Request $request)
    {
        $data = Session::get('rate_now');
        if ($_POST) {
            # code...
        }

        // if (!isset($id)) {
        //     # code...
        //     Session::flash('warning', 'Access denied');
        //     return route('user.dashboard');
        // }

        
        // $get = BoughtBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();
        // $get2 = RentedBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();

        
    }
}
