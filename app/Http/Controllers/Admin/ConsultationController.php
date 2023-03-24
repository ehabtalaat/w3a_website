<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ConsultationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Consultation\StoreRequest;
use App\Http\Requests\Admin\Consultation\UpdateRequest;
use App\Models\Consultation\Consultation;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ConsultationController extends Controller
{
    protected $view = 'admin_dashboard.consultations.';
    protected $route = 'consultations.';


    public function index(ConsultationDataTable $dataTable)
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

        $data["from_price"] = $request->from_price;
        $data["to_price"] = $request->to_price;
  
       $consultation = Consultation::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "consultations");
       }


       //save image 
       $consultation->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $consultation = Consultation::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('consultation'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $consultation = Consultation::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        $data["from_price"] = $request->from_price;
        $data["to_price"] = $request->to_price;
        
        $consultation->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $consultation->image ? delete_image($consultation->image->image) : null;
            $data_image["image"] = upload_image($request->image, "consultations");
        }


        //save image 
        $consultation->image()->updateOrCreate([
            "imageable_id" => $consultation->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $consultation = Consultation::whereId($id)->first();
        $consultation->image ? delete_image($consultation->image->image) : null;

        $consultation->delete();
        return response()->json(['status' => true]);

    }
}
