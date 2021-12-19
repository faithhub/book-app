<?php

namespace App\Http\Middleware;

use App\Models\BoughtBook;
use App\Models\Cart;
use App\Models\Rate;
use App\Models\RentedBook;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            $boughts = BoughtBook::where('user_id', Auth::user()->id)->with('book:id,vendor_id')->with('rate')->get();
            $rents = RentedBook::where('user_id', Auth::user()->id)->get();

            foreach ($rents as $rent) {
                if (Carbon::now() > $rent->return_time) {
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


            $carts = Cart::where('user_id', Auth::user()->id)->with('book')->get();
            $cart_count = $carts->count();
            $user_carts = [];
            foreach ($carts as $cart) {
                array_push($user_carts, $cart->book_id);
            }
            Session::put('user_carts', $user_carts ?? [0]);
            Session::put('my_carts', $carts);
            Session::put('my_cart_count', $cart_count);
            return $next($request);
        } else {
            Session::flash('permission_warning', 'Permission not granted');
            return redirect()->route('user.login');
        }
    }
}
