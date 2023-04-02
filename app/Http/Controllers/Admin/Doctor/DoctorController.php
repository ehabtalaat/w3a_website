<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\DataTables\Admin\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\StoreRequest;
use App\Http\Requests\Admin\Doctor\UpdateRequest;
use App\Models\LawCategory\LawCategory;
use App\Models\LawService\LawService;
use App\Models\Doctor\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DoctorController extends Controller
{
    protected $view = 'admin_dashboard.doctors.';
    protected $route = 'doctors.';

   

    public function index(DoctorDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    
    public function create()
    {

        return view($this->view . 'create');
    }

    
    public function store(StoreRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['mini_description' => $request['mini_description-' . $localeCode],
                                 'description' => $request['description-' . $localeCode],
          ];
        }
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['type'] = 2;
        $data['password'] = Hash::make($request->password);
  
  
        $doctor = Doctor::create($data);

        
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "doctors");
       }


       //save image 
       $doctor->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);
    }

    
    public function edit($id)
    {
        $doctor = Doctor::whereId($id)->firstOrFail();
        return view($this->view . 'edit',compact('doctor'));

    }

    
    public function update(UpdateRequest $request, $id)
    {
       
        $doctor = Doctor::whereId($id)->firstOrFail();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['mini_description' => $request['mini_description-' . $localeCode],
                                 'description' => $request['description-' . $localeCode],
          ];
        }
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['password'] = $request->password ? Hash::make($request->password) : $doctor->password;
  
        $doctor->update($data);



        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $doctor->image ? delete_image($doctor->image->image) : null;
            $data_image["image"] = upload_image($request->image, "doctors");
        }


        //save image 
        $doctor->image()->updateOrCreate([
            "imageable_id" => $doctor->id
        ],$data_image);
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $doctor = Doctor::whereId($id)->firstOrFail();

        $doctor->image ? delete_image($doctor->image->image) : null;

        $doctor->delete();
        return response()->json(['status' => true]);
    }

    public function active(Request $request){

        $doctor = Doctor::whereId($request->doctor_id)->first();

        $data['active'] = $doctor->active ? 0 : 1 ;
        
        $doctor->update($data);

        return response()->json([
            'status'=>true
        ]);

    }

    

}
