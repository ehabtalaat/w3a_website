<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consultation\Consultation;
use App\Models\Doctor\Doctor;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected $view = 'admin_dashboard.doctors.consultations.';
    protected $route = 'doctors.';

    public function index( $id)
    {
        $doctor = Doctor::whereId($id)->firstorFail();
        $consultations = Consultation::get();
 
        return view($this->view . 'index', compact("doctor","consultations"));
    }
    public function update(Request $request,$id){

        $doctor = Doctor::whereId($id)->firstorFail();

        $consultation_ids = $request->consultation_ids;

        $price = $request->price;

        $time = $request->time;

        $sync_data = [];

        if($consultation_ids){
        for ($i = 0; $i < count($consultation_ids); $i++) {
            $sync_data[$consultation_ids[$i]] = ['time' => $time[$i],
            'price' => $price[$i]];
        }
    }
        $doctor->consultations()->sync($sync_data);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    
    }
}
