<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaterial;
use App\Models\Country;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
        function save_file($file, $path)
        {
            $name = $path . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
            $fileDestination = $path;
            $file->move($fileDestination, $name);
            return $name;
        }
    }

    //
    public function my_books()
    {
        try {
            $data['title'] = "My Materials";
            $data['books'] = $b = Book::where('is_admin', true)->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->paginate(5);
            //dd($b);
            return view('admin.books.my-books', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }


    public function upload_new_book(Request $request)
    {
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
                    'book_cover' => ['required_if:book_cover_type,==,Book Cover', 'max:10000'],
                    'video_cover' => ['required_if:book_cover_type,==,Video Cover', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:10000'],
                    'book_material_type' => ['required'],
                    'book_material_pdf' => ['required_unless:book_material_type,5',  'mimetypes:application/pdf', 'max:15000'],
                    'book_material_video' => ['required_if:book_material_type,==,5', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:20000'],
                    'citation' => ['required_if:book_material_type,==,2', 'max:20000'],
                    'book_desc' => ['required'],
                    'policy' => ['required'],
                );

                $customMessages = [
                    'book_material_pdf.required_unless' => 'The :attribute field is required.',
                    'book_material_video.required_if' => 'The :attribute field is required.',
                    'book_cover.required_if' => 'The :attribute field is required.',
                    'video_cover.required_if' => 'The :attribute field is required.',
                    'citation.required_if' => 'The :attribute field is required.'
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
                    'policy' => 'Policy',
                    'citation' => 'Law Report Citation',
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
                if ($request->hasFile('citation')) {
                    $citation = save_file($request->file('citation'), "MATERIALPPDF");
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
                    'vendor_id' => null,
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
                    'citation' => $request->hasFile('citation') ? $citation : '',
                    'book_material_video' => $request->hasFile('book_material_video') ? $book_material_video : '',
                    'book_desc' => $request->book_desc,
                    'is_admin' => true,
                );

                Book::create($data);
                Session::flash('success', 'Material Uploaded Successfully');
                return redirect()->route('admin.materials');
            }

            $data['title'] = "Admin Upload New Material";
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            return view('admin.books.upload', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }


    public function view_book($id)
    {
        try {
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['vendor_id' => Auth::guard('vendor')->user()->id, 'id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('vendor.books.view-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', "Material not found");
            return redirect(RouteServiceProvider::ADMIN);
        }
    }

    public function edit_book(Request $request, $name, $id)
    {
        try {
            $my_book = Book::where(['is_admin' => true, 'id' => $id])->first();
            if ($my_book == null) {
                Session::flash('warning', 'Unable to access this material');
                return back();
            }

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
                    // 'book_cover' => ['required_if:book_cover_type,==,Book Cover', 'max:10000'],
                    // 'video_cover' => ['required_if:book_cover_type,==,Video Cover', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:10000'],
                    'book_material_type' => ['required'],
                    'citation' => ['required_if:book_material_type,==,2',  'max:15000'],
                    // 'book_material_pdf' => ['required_unless:book_material_type,5',  'mimetypes:application/pdf', 'max:15000'],
                    // 'book_material_video' => ['required_if:book_material_type,==,5', 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'max:20000'],
                    'book_desc' => ['required'],
                    'policy' => ['required'],
                );

                $customMessages = [
                    'book_material_pdf.required_unless' => 'The :attribute field is required.',
                    'book_material_video.required_if' => 'The :attribute field is required.',
                    'book_cover.required_if' => 'The :attribute field is required.',
                    'video_cover.required_if' => 'The :attribute field is required.',
                    'citation.required_if' => 'The :attribute field is required.'
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
                    'policy' => 'Policy',
                    'citation' => 'Law Report Citation',
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
                if ($request->hasFile('citation')) {
                    $citation = save_file($request->file('citation'), "MATERIALPPDF");
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

                $book = Book::find($request->id);
                $data = array(
                    'book_author' => $request->book_author,
                    'book_name' => $request->book_name,
                    'book_year' => $request->book_year,
                    'book_country' => $request->book_country,
                    'book_cat' => $request->book_cat,
                    'book_paid_free' => $request->book_paid_free,
                    'book_price' => $request->book_price ?? '',
                    'book_tag' => $request->book_tag,
                    'book_cover_type' => $request->book_cover_type,
                    'book_cover' => $request->hasFile('book_cover') ? $book_cover : $book->book_cover,
                    'video_cover' => $request->hasFile('video_cover') ? $video_cover : $book->video_cover,
                    'book_material_type' => $request->book_material_type,
                    'book_material_pdf' => $request->hasFile('book_material_pdf') ? $book_material_pdf : $book->book_material_pdf,
                    'citation' => $request->hasFile('citation') ? $citation : $book->citation,
                    'book_material_video' => $request->hasFile('book_material_video') ? $book_material_video : $book->book_material_video,
                    'book_desc' => $request->book_desc,
                );

                DB::table('books')->where('id', $request->id)->update($data);
                Session::flash('success', 'Material Updated Successfully');
                return redirect()->route('admin.materials');
            }
            $data['book_cats'] = BookCategory::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['countries'] = Country::orderBy('id', 'asc')->get();
            $data['materials'] = BookMaterial::where(['status' => 'Active', 'role' => 'Vendor'])->orderBy('name', 'asc')->get();
            $data['book'] = $b = Book::where(['is_admin' => true, 'id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            $data['title'] = $b->book_name;
            return view('admin.books.edit', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }


    public function access_book($name, $id)
    {
        try {
            $my_book = Book::where(['vendor_id' => Auth::guard('vendor')->user()->id, 'id' => $id])->first();
            if ($my_book == null) {
                Session::flash('warning', 'Unable to access this material');
                return back();
            }
            $data['book'] = $b = Book::where(['id' => $id])->with(['category:id,name', 'material:id,name', 'country:id,country_label'])->orderBy('id', 'asc')->first();
            //dd($b->material->name);
            if ($b->material->name == "Videos") {
                $data['material_type'] = 'Video';
                $data['material'] = $d = asset('VIDEOMAT/' . $b->book_material_video);
            } else {
                $data['material_type'] = 'PDF';
                $data['material'] = $d = asset('MATERIALPPDF/' . $b->book_material_pdf);
            }
            //dd($d);
            //$data['material_type'] = 'Video';
            $data['title'] = $b->book_name;
            return view('vendor.books.access-book', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
}
