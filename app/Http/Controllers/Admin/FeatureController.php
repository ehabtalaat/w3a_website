<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FeatureDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\StoreRequest;
use App\Http\Requests\Feature\UpdateRequest;
use App\Models\Feature\Feature;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FeatureController extends Controller
{
    protected $view = 'admin_dashboard.features.';
    protected $route = 'features.';


    public function index(FeatureDataTable $dataTable)
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
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
  
        //create
       $feature = Feature::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "features");
       }


       //save image 
       $feature->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $feature = Feature::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('feature'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $feature = Feature::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        //update
        
        $feature->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $feature->image ? delete_image($feature->image->image) : null;
            $data_image["image"] = upload_image($request->image, "features");
        }


        //save image 
        $feature->image()->updateOrCreate([
            "imageable_id" => $feature->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $feature = Feature::whereId($id)->first();

        //delete image
        $feature->image ? delete_image($feature->image->image) : null;

        //delete
        $feature->delete();
        return response()->json(['status' => true]);

    }
}
