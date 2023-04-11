<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\ConsultationResource;
use App\Http\Resources\Website\DoctorResource;
use App\Models\Consultation\Consultation;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;

class ConsultationController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $consultations = Consultation::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_consultations";
            $data =  ConsultationResource::collection($consultations);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_consultation_doctors(Request $request){
        try{

               //validation

               $rules = [
                "consultation_id" => "required|exists:consultations,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $consultation = Consultation::whereId($request->consultation_id)->first();

             $doctors = $consultation->doctors;


                
            $msg = "fetch_consultation_doctors";

            $data =  DoctorResource::collection($doctors);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
