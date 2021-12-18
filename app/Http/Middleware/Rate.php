<?php

namespace App\Http\Middleware;

use App\Models\BoughtBook;
use App\Models\RentedBook;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Rate
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
            $boughts = BoughtBook::where('user_id', Auth::user()->id)->with('book:id,vendor_id,book_name')->with('rate')->get();
            $rents = RentedBook::where('user_id', Auth::user()->id)->get();

            //Rate
            foreach ($boughts as $data) {
                # code...
                if (!isset($data->rate)) {
                    $rate_data = [
                        'book_name' => $data->book->book_name,
                        'vendor_id' => $data->book->vendor_id,
                        'book_id' => $data->book_id,
                        'type' => 'Buy'
                    ];
                    Session::put('rate_now', $rate_data);
                    return redirect('user/rate');
                }
            }

            foreach ($rents as $data) {
                # code...
                if (!isset($data->rate)) {
                    $rate_data = [
                        'book_name' => $data->book->book_name,
                        'vendor_id' => $data->book->vendor_id,
                        'book_id' => $data->book_id,
                        'type' => 'Buy'
                    ];
                    Session::put('rate_now', $rate_data);
                    return redirect('user/rate');
                }
            }
            return $next($request);
        } else {
            Session::flash('permission_warning', 'Permission not granted');
            return redirect()->route('user.login');
        }
    }
}
