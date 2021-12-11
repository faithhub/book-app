<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\Country;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.vendor');
    }

    public function my_books()
    {
        try {
            if (View::exists('vendor.books.my-books')) {
                $data['title'] = "Vendor My Books";
                return view('vendor.books.my-books', $data);
            }

            abort(Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }
    public function upload_new_book(Request $request)
    {
        try {

            if ($_POST) {
                $rules = array(
                    'book_cat' => ['required', 'max:255'],
                    'book_name' => ['required', 'min:11', 'max:11'],
                    'book_price' => ['required', 'max:255'],
                    'book_rent' => ['required', 'max:255'],
                    'book_author' => ['required', 'max:255'],
                    'book_pdf' => ['required', 'max:255'],
                    'book_desc' => ['required', 'max:255'],
                );

                $fieldNames = array(
                    'book_cat' => 'Book Category',
                    'book_name' => 'Book Title',
                    'book_rent' => 'Book Rent Per Day',
                    'book_price' => 'Book Price',
                    'book_author' => 'Book Author',
                    'book_pdf' => 'Book PDF',
                    'book_desc' => 'Book Description',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('error', 'Error fill your data appropriately');
                    return back()->withErrors($validator)->withInput();
                }

                $file = $request->file('book_pdf');
                $book_name = 'BOOkPDF' . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
                $fileDestination = 'books';
                $file->move($fileDestination, $book_name);

                $data = array(
                    'vendor_id' => Auth::guard('vendor')->user()->id,
                    'book_cat' => $request->book_cat,
                    'book_name' => $request->book_name,
                    'book_rent' => $request->book_rent,
                    'book_price' => $request->book_price,
                    'book_author' => $request->book_author,
                    'book_pdf' => $book_name,
                    'book_desc' => $request->book_desc,
                );

                Book::create($data);
                Session::flash('success', 'Book Uloaded Successfully');
                return redirect()->route('vendor.my.books');
            }

            $data['title'] = "Vendor Upload New Book";
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            return view('vendor.books.upload-new-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::VENDOR);
        }
    }

    public function view_book()
    {
        $filename = 'test.pdf';
        $path = storage_path($filename);
        return FacadesResponse::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
