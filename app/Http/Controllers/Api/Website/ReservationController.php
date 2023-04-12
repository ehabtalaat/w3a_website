<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorConsultation;
use App\Models\Reservation\Reservation;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
class ReservationController extends Controller
{
    use ApiTrait;
    public function store(Request $request){
        try{   
            $rules = [
                "doctor_id" => "required|exists:doctors,id",
                "consultation_id" => "required|exists:consultations,id",
                "doctor_day_time_id" => "required|exists:doctor_day_times,id",
                "user_name" => "required",
                "user_phone" => "required",
                "contact_type" => "required|numeric|min:1|max:2",
                "for_another_person" => "required|numeric|min:0|max:1",
                "another_person_name" => "sometimes",
                "another_person_phone" => "sometimes",
                "date" => "required|date",
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return $this->getvalidationErrors($validator,422);
            }

            $doctor = Doctor::whereId($request->doctor_id)->first();
           

            $doctor_consultation = DoctorConsultation::where([['doctor_id','=',$request->doctor_id],['consultation_id','=',$request->consultation_id]])->first();

       
            $data['lawyer_id'] = $request->lawyer_id;
            $data['consultation_id'] = $request->consultation_id;
            $data['user_name'] = $request->user_name;
            $data['user_phone'] = $request->user_phone;
            $data['contact_type'] = $request->contact_type;
            $data['for_another_person'] = $request->for_another_person;

            if($request->for_another_person == 1){
            $data['another_person_name'] = $request->another_person_name;
            $data['another_person_phone'] = $request->another_person_phone;
            }

            $data['date'] = $request->date;
            $data['price'] = $doctor_consultation->price ?? 0;
            $data['time'] = $doctor_consultation->time ?? 0;
             $data['doctor_day_time_id'] = $request->doctor_day_time_id;

            
            $reservations = Reservation::create($data);

            
            $msg = __("messages.save successful");
            return $this->successResponse($msg,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
