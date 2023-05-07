<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\DataTables\Admin\DoctorCertificateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorCertificate\StoreRequest;
use App\Http\Requests\Admin\DoctorCertificate\UpdateRequest;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorCertificate;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DoctorCertificateController extends Controller
{
    protected $view = 'admin_dashboard.doctors.certificates.';
    protected $route = 'doctor_certificates.';



    public function index(DoctorCertificateDataTable $dataTable,$id)
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
        //create
       $certificate = DoctorCertificate::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "certificates");
       }


       //save image 
       $certificate->image()->create($data_image);

        return redirect()->route($this->route."index",["id" => $certificate->id])
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $certificate = DoctorCertificate::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('certificate'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $certificate = DoctorCertificate::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        //update
        
        $certificate->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $certificate->image ? delete_image($certificate->image->image) : null;
            $data_image["image"] = upload_image($request->image, "certificates");
        }


        //save image 
        $certificate->image()->updateOrCreate([
            "imageable_id" => $certificate->id
        ],$data_image);

        return redirect()->route($this->route."index",["id" => $certificate->id])
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $certificate = DoctorCertificate::whereId($id)->first();

        //delete image
        $certificate->image ? delete_image($certificate->image->image) : null;

        //delete
        $certificate->delete();
        return response()->json(['status' => true]);

    }
}
