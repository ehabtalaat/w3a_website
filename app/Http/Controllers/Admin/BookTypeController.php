<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BookTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookType\StoreRequest;
use App\Http\Requests\Admin\BookType\UpdateRequest;
use App\Models\BookType\BookType;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BookTypeController extends Controller
{
    protected $view = 'admin_dashboard.book_types.';
    protected $route = 'book_types.';


    public function index(BookTypeDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    
    public function create()
    {
        return view($this->view . 'create' );
    }

    
    public function store(StoreRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
          ];
        }
  
        //create
       $book_type = BookType::create($data);

    

     

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $book_type = BookType::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('book_type'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $book_type = BookType::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
          ];
        }
      
        //update
        
        $book_type->update($data);

      
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $book_type = BookType::whereId($id)->first();

        //delete
        $book_type->delete();
        return response()->json(['status' => true]);

    }
}
