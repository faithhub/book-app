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
        function save_file($file, $path)
        {
            $name = $path . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
            $fileDestination = $path;
            $file->move($fileDestination, $name);
            return $name;
        }
        try {

            if ($_POST) {
                $rules = array(
                    'book_author' => ['required'],
                    'book_name' => ['required'],
                    'book_year' => ['required'],
                    'book_country' => ['required'],
                    'book_cat' => ['required'],
                    'book_paid_free' => ['required'],
                    'book_price' => ['required_if:book_paid_free,==,Paid'],
                    'book_tag' => ['required'],
                    'book_cover_type' => ['required'],
                    'book_cover' => ['required_if:book_cover_type,==,Book Cover'],
                    'video_cover' => ['required_if:book_cover_type,==,Video Cover'],
                    'book_material_type' => ['required'],
                    'book_material_pdf' => ['required_unless:book_material_type,5'],
                    'book_material_video' => ['required_if:book_material_type,==,5'],
                    'book_desc' => ['required'],
                );

                $customMessages = [
                    'book_material_pdf.required_unless' => 'The :attribute field is required.',
                    'book_material_video.required_if' => 'The :attribute field is required.',
                    'book_cover.required_if' => 'The :attribute field is required.',
                    'video_cover.required_if' => 'The :attribute field is required.'
                ];

                $fieldNames = array(
                    'book_cat' => 'Book Category',
                    'book_year' => 'Year of Publish',
                    'book_paid_free' => 'Paid/Free',
                    'book_country' => 'Country of Publish',
                    'book_material_type' => 'Type of Material',
                    'book_material_pdf' => 'Material PDF',
                    'book_material_video' => 'Material Video',
                    'book_cover_type' => 'Book Cover Type',
                    'book_cover' => 'Book Cover',
                    'video_cover' => 'Video Cover',
                    'book_name' => 'Title of Material',
                    'book_price' => 'Book Price',
                    'book_tag' => 'Tag',
                    'book_author' => 'Book Author',
                    'book_desc' => 'Book Description',
                );

                $validator = Validator::make($request->all(), $rules, $customMessages);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('book_material_video')) {
                    $book_material_video = save_file($request->file('book_material_video'), "VIDEOMAT");
                }
                if ($request->hasFile('book_material_pdf')) {
                    $book_material_pdf = save_file($request->file('book_material_pdf'), "MATERIALPPDF");
                }
                if ($request->hasFile('book_cover')) {
                    $book_cover = save_file($request->file('book_cover'), "BOOKCOVER");
                }
                if ($request->hasFile('video_cover')) {
                    $video_cover = save_file($request->file('video_cover'), "VIDEOCOVER");
                }

                $data = array(
                    'vendor_id' => Auth::guard('vendor')->user()->id,
                    'book_author' => $request->book_author,
                    'book_name' => $request->book_name,
                    'book_year' => $request->book_year,
                    'book_country' => $request->book_country,
                    'book_cat' => $request->book_cat,
                    'book_paid_free' => $request->book_paid_free,
                    'book_price' => $request->book_price ?? '',
                    'book_tag' => $request->book_tag,
                    'book_cover_type' => $request->book_cover_type,
                    'book_cover' => $request->hasFile('book_cover') ? $book_cover : '',
                    'video_cover' => $request->hasFile('video_cover') ? $video_cover : '',
                    'book_material_type' => $request->book_material_type,
                    'book_material_pdf' => $request->hasFile('book_material_pdf') ? $book_material_pdf : '',
                    'book_material_video' => $request->hasFile('book_material_video') ? $book_material_video : '',
                    'book_desc' => $request->book_desc,
                );

                //dd($data);

                Book::create($data);
                Session::flash('success', 'Material Uploaded Successfully');
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
