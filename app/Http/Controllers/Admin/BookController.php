<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\BookType\Book;
use App\Models\BookType\BookType;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class BookController extends Controller
{
    protected $view = 'admin_dashboard.books.';
    protected $route = 'books.';


    public function index(BookDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    public function create()
    {

        $book_types =  BookType::get();
        return view($this->view . 'create',compact("book_types"));
    }

    public function store(Request $request)
    {

        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['text-' . $localeCode] = ['sometimes',
            ];
        }
        $rules["pdf"] = ["required", "mimetypes:application/pdf"];
        $rules["image"] = ["required", "mimes:jpeg,jpg,png,gif"];

        $validator = Validator::make($request->all(), $rules, [
            'pdf.mimes' => 'هذا الحقل يقبل pdf فقط',
            'image.mimes' => 'هذا الحقل يقبل صوره فقط',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }


        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],
                'mini_text' => $request['mini_text-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }


        if ($request->hasFile('pdf')) {
            $data["pdf"] = upload_pdf($request->pdf, "books");
        }

      
        $data["price"] = $request->price;
        $data["number_of_pages"] = $request->number_of_pages;
        $data["type"] = $request->type;
        $data["book_type_id"] = $request->book_type_id;

        $book = Book::create($data);


        $data_image = [];

        //update image
 
        if ($request->hasFile('image')) {
            $data_image["image"] = upload_image($request->image, "books");
        }
 
 
        //save image 
        $book->image()->create($data_image);
    


        $message = __("messages.createmessage");
        return response()->json(["status" => true, "message" => $message, "lesson_id" => $book->lesson_id]);
    }

    public function edit($id)
    {
        $book = Book::whereId($id)->firstOrFail();
        $book_types =  BookType::get();

        return view($this->view . 'edit', compact("book","book_types"));
    }

    public function update(Request $request, $id)
    {
        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['text-' . $localeCode] = ['sometimes',
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }

        $book = Book::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],
                'mini_text' => $request['mini_text-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }
 
        if ($request->hasFile('pdf')) {
            $book->pdf ? delete_image($book->pdf) : "";

            $data["pdf"] = upload_pdf($request->pdf, "books");
        }

        $data["price"] = $request->price;
        $data["number_of_pages"] = $request->number_of_pages;
        $data["type"] = $request->type;
        $data["book_type_id"] = $request->book_type_id;

     
        $book->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $book->image ? delete_image($book->image->image) : null;
            $data_image["image"] = upload_image($request->image, "books");
        }


        //save image 
        $book->image()->updateOrCreate([
            "imageable_id" => $book->id
        ],$data_image);


        // return redirect()->route($this->route . "index", ["id" => $book->part_id])
        //     ->with(['success' => __("messages.editmessage")]);
        $message = __("messages.editmessage");
        return response()->json(["status" => true, "message" => $message]);
    }

    public function destroy($id)
    {
        $book = Book::whereId($id)->first();

        $book->pdf ? delete_image($book->pdf) : "";

        $book->image ? delete_image($book->image->image) : null;

        $book->delete();

        return response()->json(['status' => true]);
    }
}
