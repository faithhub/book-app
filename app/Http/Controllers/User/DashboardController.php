<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\BoughtBook;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Group;
use App\Models\Rate;
use App\Models\RentedBook;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Str;

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
            $data['featured'] = $f = Book::orderBy('rating', 'desc')->first();
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
            $rent_g = [];
            $bought_g = [];
            if (Auth::user()->in_group) {
                # code...
                $data['group'] = $group = Group::find(Auth::user()->group_id);
                $data['rent_g'] = $r = RentedBook::whereIn('user_id', $group->group_members)->get('book_id');
                foreach ($r as $r_g) {
                    # code...
                    array_push($rent_g, $r_g->book_id);
                }
                $data['bought_g'] = $b = BoughtBook::whereIn('user_id', $group->group_members)->get('book_id');
                foreach ($b as $b_g) {
                    # code...
                    array_push($bought_g, $b_g->book_id);
                }
            }
            // dd($bought_g, $rent_g);
            $data['rent_g'] = $rent_g;
            $data['bought_g'] = $bought_g;
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label', 'rate'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('user.dashboard.view-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', "Material not found");
            //dd($th->getMessage());
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
            $data['title'] = "Rent Books";
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
                if ($request->type == "Material") {
                    if ($request->mat_id == null) {
                        $data['books'] = $b = Book::with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'desc')->paginate(12);
                        return view('user.dashboard.search', $data);
                    } else {
                        $data['books'] = $b = Book::where('book_material_type', 'LIKE', '%' . $request->mat_id . '%')
                            ->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'desc')->paginate(12);
                        return view('user.dashboard.search', $data);
                    }
                }
                if ($request->book_name == null && $request->book_author == null && $request->book_material_type == null && $request->book_cat == null && $request->book_paid_free == null) {
                    return view('user.dashboard.search', $data);
                }

                $data['books'] = $b = Book::where('book_name', 'LIKE', '%' . $request->book_name . '%')
                    // ->orwhere('book_author', 'LIKE', '%' . $request->book_author . '%')
                    // ->orwhere('book_material_type', 'LIKE', '%' . $request->book_material_type . '%')
                    // ->orwhere('book_cat', 'LIKE', '%' . $request->book_cat . '%')
                    // ->orwhere('book_country', 'LIKE', '%' . $request->book_country . '%')
                    // ->orwhere('book_paid_free', 'LIKE', '%' . $request->book_paid_free . '%')
                    ->orwhere('book_tag', 'LIKE', '%' . $request->book_tag . '%')
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
            $book = Book::find($id);
            $rent = RentedBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();
            $bought = BoughtBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->first();

            $rent_g = [];
            $bought_g = [];

            if ($book->book_paid_free == 'Paid') {
                if (Auth::user()->in_group) {
                    # code...
                    $data['group'] = $group = Group::find(Auth::user()->group_id);
                    $data['rent_g'] = $r = RentedBook::whereIn('user_id', $group->group_members)->get('book_id');
                    foreach ($r as $r_g) {
                        # code...
                        array_push($rent_g, $r_g->book_id);
                    }
                    $data['bought_g'] = $b = BoughtBook::whereIn('user_id', $group->group_members)->get('book_id');
                    foreach ($b as $b_g) {
                        # code...
                        array_push($bought_g, $b_g->book_id);
                    }
                    if (!in_array($id, $bought_g) && !in_array($id, $rent_g)) {
                        # code...
                        Session::flash('warning', 'You do not have permision to access this material');
                        return back();
                    }
                } else {
                    if ($rent == null & $bought == null) {
                        Session::flash('warning', 'You do not have permision to access this material');
                        return back();
                    }
                    if ($rent != null) {
                        if (Carbon::now() > $rent->return_time) {
                            $rent->delete();
                            Session::flash('warning', 'Rent period for this material has expired, you do not have permision to access this material');
                            return route('user.dashboard');
                        }
                    }
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
            // $data['material_type'] = 'Video';
            $data['title'] = $b->book_name;
            return view('user.dashboard.access-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', "Material not found");
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function save_payment(Request $request)
    {
        try {
            $rate_data = [];
            function book_data()
            {
                $boughts = BoughtBook::where('user_id', Auth::user()->id)->get();
                $rents = RentedBook::where('user_id', Auth::user()->id)->get();
                foreach ($rents as $rent) {
                    if (Carbon::now() > $rent->return_time) {
                        dd(Carbon::now(), $rent->return_time);
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
                    'book_id' => $request->book_id,
                    'rated' => 'No',
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
                    'rated' => 'No',
                    'return_time' => Carbon::now()->addDays(1)
                ];
                $request->all();
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
                    'book_id' => $cart->book_id,
                    'rated' => 'No'
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
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function rate(Request $request)
    {
        try {

            $rate_data = Session::get('rate_now');
            $data['title'] = 'Rate Material (' . $rate_data['book_name'] . ')';
            $data['book_name'] = $rate_data['book_name'];

            if ($_POST) {
                $rules = array(
                    'rate' => ['required'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'Rate is required');
                    return back()->withErrors($validator)->withInput();
                }

                Rate::create([
                    'user_id' => Auth::user()->id,
                    'vendor_id' => $rate_data['vendor_id'] ?? null,
                    'book_id' => $rate_data['book_id'],
                    'type' => $rate_data['type'],
                    'rate' => $request->rate,
                ]);


                $total_point = Rate::where('book_id', $rate_data['book_id'])->sum('rate');
                $total_count = Rate::where('book_id', $rate_data['book_id'])->count();
                $final_rate = round($total_point / $total_count, 0);

                //dd($final_rate);
                if ($rate_data['type'] == 'Buy') {
                    BoughtBook::where([
                        'user_id' => Auth::user()->id,
                        'book_id' => $rate_data['book_id'],
                    ])->first()
                        ->update([
                            'rated' => 'Yes',
                            'rated_point' => $request->rate
                        ]);
                }

                if ($rate_data['type'] == 'Rent') {
                    RentedBook::where([
                        'user_id' => Auth::user()->id,
                        'book_id' => $rate_data['book_id'],
                    ])->first()
                        ->update([
                            'rated' => 'Yes',
                            'rated_point' => $request->rate
                        ]);
                }

                Book::where(['vendor_id' => $rate_data['vendor_id'], 'id' => $rate_data['book_id']])->update([
                    'rating' => $final_rate,
                ]);


                Session::flash('success', 'Rated successfully');
                Session::forget('rate_now');
                return redirect()->route('user.dashboard');
            }

            if (!isset($rate_data)) {
                return redirect()->route('user.dashboard');
            }
            return view('user.dashboard.rate', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function subscription(Request $request)
    {
        # code...
        if ($_POST) {
            $date_now = Carbon::now();
            # code...
            // return $request->all();
            //return $request->all();
            function save_sub($plan, $request, $in_group, $group_id, $is_group)
            {
                $data = array(
                    'user_id' => Auth::user()->id,
                    'ref' => $request->ref,
                    'amount' => $request->plan_amount
                );
                $user = User::find(Auth::user()->id);

                function save_grp($request, $expire_date)
                {
                    $find_group = Group::where('user_id', Auth::user()->id)->first();
                    if (isset($find_group->id)) {
                        # code...
                        $group_id = $find_group->id;
                    } else {
                        $group = Group::create([
                            'name' => Str::uuid(),
                            'user_id' => Auth::user()->id,
                            'group_members' => [Auth::user()->id],
                            'books' => null,
                            'plan_id' => $request->plan_id,
                            'plan' => $request->plan_type,
                            'plan_start' => Carbon::now(),
                            'plan_ended' => $expire_date,
                        ]);
                        $group_id = $group->id;
                    }
                    return $group_id;
                }
                switch ($request->plan_type) {
                    case 'weekly':
                        # code...
                        if ($is_group) {
                            # code...
                            $group_id = save_grp($request, Carbon::now()->addWeek());
                        }
                        $user->in_group = $in_group;
                        $user->group_id = $group_id;
                        $user->plan_id = $request->plan_id;
                        $user->plan = $request->plan_type;
                        $user->plan_start = Carbon::now();
                        $user->plan_ended = Carbon::now()->addWeek();
                        $user->save();
                        Transaction::create($data);
                        break;
                    case 'monthly':
                        # code...
                        if ($is_group) {
                            # code...
                            $group_id = save_grp($request, Carbon::now()->addMonth());
                        }
                        $user->plan_id = $request->plan_id;
                        $user->in_group = $in_group;
                        $user->group_id = $group_id;
                        $user->active_group = true;
                        $user->plan = $request->plan_type;
                        $user->plan_start = Carbon::now();
                        $user->plan_ended = Carbon::now()->addMonth();
                        $user->save();
                        Transaction::create($data);
                        break;
                    case 'quarterly':
                        # code...
                        $user->plan_id = $request->plan_id;
                        $user->in_group = $in_group;
                        $user->group_id = $group_id;
                        $user->plan = $request->plan_type;
                        $user->plan_start = Carbon::now();
                        $user->plan_ended = Carbon::now()->addQuarter();
                        $user->save();
                        Transaction::create($data);
                        break;
                    case 'annually':
                        # code...
                        $user->plan_id = $request->plan_id;
                        $user->in_group = $in_group;
                        $user->group_id = $group_id;
                        $user->plan = $request->plan_type;
                        $user->plan_start = Carbon::now();
                        $user->plan_ended = Carbon::now()->addYear();
                        $user->save();
                        Transaction::create($data);
                        break;
                    default:
                        # code...
                        break;
                }
            }
            switch ($request->plan) {
                case 'Single User':
                    # code...
                    save_sub('Single User', $request, false, Null, false);
                    Session::flash('success', 'Subscription successful');
                    return true;
                    break;
                case 'Group Users (5)':
                    # code...
                    save_sub('Group Users (5)', $request, true, null, true);
                    Session::flash('success', 'Subscription successful');
                    return true;
                    break;
                case 'Group Users (10)':
                    # code...
                    break;

                default:
                    # code...
                    break;
            }
        }
        // dd(Str);

        $data['group_admin'] = true;
        if (Auth::user()->in_group) {
            # code...
            $data['group'] = $group = Group::find(Auth::user()->group_id);
            if (Auth::user()->id != $group->user_id) {
                # code...
                $data['group_admin'] = false;
            }
        }
        $data['title'] = "Subscriptions";
        $data['subs'] = Subscription::all();
        return view('user.sub.index', $data);
    }


    public function group()
    {
        $data['group'] = $group = Group::find(Auth::user()->group_id);
        $data['title'] = 'Group';
        $data['sn'] = 1;
        $data['users'] = User::where('group_id', $group->id)->get();
        return view('user.group.index', $data);
    }

    public function group_bought_books()
    {
        try {
            $group = Group::find(Auth::user()->group_id);
            $data['books'] = $b = BoughtBook::whereIn('user_id', $group->group_members)->with('book')->paginate(15);
            $data['title'] = "Group Bought Books";
            return view('user.group.bought', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }

    public function group_rent_books()
    {
        try {
            $group = Group::find(Auth::user()->group_id);
            $data['books'] = $b = RentedBook::whereIn('user_id', $group->group_members)->with('book')->paginate(15);
            $data['title'] = "Group Rent Books";
            return view('user.group.rent', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::USER);
        }
    }


    public function delete_group_member($id)
    {
        # code...
        // $user = User::where('id', $id)->first();
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            Session::flash('warning', 'User not found');
            return back();
        }
        $check_admin = Group::where(['user_id' => Auth::user()->id, 'id' => $user->group_id])->where('user_id', '!=', $user->id)->first();
        if (!isset($check_admin)) {
            Session::flash('warning', 'You do not have permission to delete this user');
            return back();
        }
        // $user->delete();
        $user_key = array_search($user->id, $check_admin->group_members);
        if ($user_key) {
            # code...
            unset($check_admin->group_members[$user_key]);
        }
        User::find($id)->delete();
        Session::flash('success', 'User Deleted Successfully');
        return back();
    }

    public function create_group_member(Request $request)
    {
        $data['group'] = $group = Group::where('user_id', Auth::user()->id)->first();
        if (count($group->group_members) >= 5) {
            # code...
            Session::flash('warning', 'You have reached maximum user');
            return back();
        }
        # code...
        if ($_POST) {
            # code...

            $rules = array(
                'name' => ['required', 'max:255'],
                'username' => ['required', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'mobile' => ['required', 'min:11', 'max:11'],
                'password' => ['required', 'min:8', 'confirmed'],
                'gender' => ['required', 'max:255'],
                'dob' => ['required', 'max:255'],
            );

            $fieldNames = array(
                'name' => 'Full Name',
                'email' => 'Email',
                'username' => 'Username',
                'mobile' => 'Mobile Number',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password',
                'dob' => 'Date Of Birth',
                'gender' => 'Gender',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                Session::flash('error', 'Error fill your data appropriately');
                return back()->withErrors($validator)->withInput();
            }

            $data = array(
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'dob' => $request->dob,
                'in_group' => true,
                'group_id' => $group->id,
                'plan_id' => $group->plan_id,
                'plan' => $group->plan,
                'active_group' => true,
                'plan_start' => $group->plan_start,
                'plan_ended' => $group->plan_ended,
            );

            $group_id_array = $group->group_members;
            $user = User::create($data);
            array_push($group_id_array, $user->id);
            $group->group_members = $group_id_array;
            $group->save();
            Session::flash('success', 'New Member Added successfully');
            return redirect()->route('user.group');
        }
        $data['title'] = 'Create New Group Member';
        return view('user.group.create', $data);
    }
}
