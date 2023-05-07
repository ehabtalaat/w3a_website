<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\DataTables\Admin\DoctorExperienceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorExperience\StoreRequest;
use App\Http\Requests\Admin\DoctorExperience\UpdateRequest;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorExperience;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DoctorExperienceController extends Controller
{
    protected $view = 'admin_dashboard.doctors.experiences.';
    protected $route = 'doctor_experiences.';

  

    public function index(DoctorExperienceDataTable $dataTable,$id)
    {
        $doctor = Doctor::whereId($id)->firstOrFail();
        $dataTable->id = $id;
        return $dataTable->render($this->view . 'index',["doctor" => $doctor]);
    }

    
    public function create($id)
    {
        $doctor = Doctor::whereId($id)->firstOrFail();

        return view($this->view . 'create',compact("doctor"));
    }

    
    public function store(StoreRequest $request,$id)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
        $data["doctor_id"] = $id;
  
       $experience = DoctorExperience::create($data);

    
      

        return redirect()->route($this->route."index",["id" => $experience->doctor_id])
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $experience = DoctorExperience::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('experience'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $experience = DoctorExperience::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        
        $experience->update($data);

   
      

        return redirect()->route($this->route."index",["id" => $experience->doctor_id])
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $experience = DoctorExperience::whereId($id)->first();

        $experience->delete();
        return response()->json(['status' => true]);

    }
}
