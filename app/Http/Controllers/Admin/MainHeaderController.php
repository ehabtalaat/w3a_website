<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MainHeaderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainHeader\UpdateRequest;
use App\Models\MainHeader\MainHeader;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MainHeaderController extends Controller
{
    protected $view = 'admin_dashboard.main_headers.';
    protected $route = 'main_headers.';



    public function index(MainHeaderDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    
    public function create()
    {
        return view($this->view . 'create' );
    }

    
    public function store(UpdateRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
  
        //create
       $main_header = MainHeader::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "main_headers");
       }


       //save image 
       $main_header->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $main_header = MainHeader::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('main_header'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $main_header = MainHeader::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        //update
        
        $main_header->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $main_header->image ? delete_image($main_header->image->image) : null;
            $data_image["image"] = upload_image($request->image, "main_headers");
        }


        //save image 
        $main_header->image()->updateOrCreate([
            "imageable_id" => $main_header->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $main_header = MainHeader::whereId($id)->first();

        //delete image
        $main_header->image ? delete_image($main_header->image->image) : null;

        //delete
        $main_header->delete();
        return response()->json(['status' => true]);

    }
}
