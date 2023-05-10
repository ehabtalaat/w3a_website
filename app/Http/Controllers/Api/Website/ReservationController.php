<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\ReservationResource;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorConsultation;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Reservation\Reservation;
use App\Models\Reservation\ReservationResult;
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
                "payment_method_id" => "required|exists:payment_methods,id",
                "user_name" => "required",
                "user_phone" => "required",
                "contact_type" => "required|numeric|min:1|max:2",
                "for_another_person" => "required|numeric|min:0|max:1",
                "another_person_name" => "sometimes",
                "another_person_phone" => "sometimes",
                "date" => "required|date",
                "images" => "array"
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return $this->getvalidationErrors($validator,422);
            }

            $doctor = Doctor::whereId($request->doctor_id)->first();
           

            $doctor_consultation = DoctorConsultation::where([['doctor_id','=',$request->doctor_id],['consultation_id','=',$request->consultation_id]])->first();

            $payment_method = PaymentMethod::whereId($request->payment_method_id)->first();
            $data['user_id'] = auth()->id();
       
            $data['doctor_id'] = $request->doctor_id;
            $data['consultation_id'] = $request->consultation_id;
            $data['payment_method_id'] = $request->payment_method_id;
            $data['user_name'] = $request->user_name;
            $data['user_phone'] = $request->user_phone;
            $data['contact_type'] = $request->contact_type;
            $data['for_another_person'] = $request->for_another_person;
            $data['image_required'] = $payment_method->image_required;
            $data['code_required'] = $payment_method->code_required;

            if($request->for_another_person == 1){
            $data['another_person_name'] = $request->another_person_name;
            $data['another_person_phone'] = $request->another_person_phone;
            }

            $data['date'] = $request->date;
            $data['price'] = $doctor_consultation->price ?? 0;
            $data['time'] = $doctor_consultation->time ?? 0;
             $data['doctor_day_time_id'] = $request->doctor_day_time_id;
             $data['patient_notes'] = $request->patient_notes;

            
            $reservation = Reservation::create($data);

           if($request->images && count($request->images) > 0){
            foreach($request->images as $image){
                $data_image["image"] = upload_image($image, "reservations");
                 //save image 
            $reservation->images()->create($data_image);
            }
            }
     
     
           
            
            $msg = __("messages.save successful");
            return $this->successResponse($msg,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
    public function fetch_your_reservations(){
        try{ 
            
            $reservations = Reservation::orderBy("id","desc")->whereUserId(auth()->id())->paginate(6);

            //response

          
            
            $msg = "fetch_your_reservations";
            $data =  ReservationResource::collection($reservations)->response()->getData(true);;

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function reservation_details(Request $request){
        try{

               //validation

               $rules = [
                "reservation_id" => "required|exists:reservations,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $reservation = Reservation::whereId($request->reservation_id)->first();



                
            $msg = "reservation_details";

            $data = new ReservationResource($reservation);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    public function cancel_reservation(Request $request){
        try{

               //validation

               $rules = [
                "reservation_id" => "required|exists:reservations,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $reservation = Reservation::whereId($request->reservation_id)->first();


             $data["status"] = 3;
             $reservation->update($data);

                
            $msg = "تم الغاء الحجز بنجاح";

            $data = new ReservationResource($reservation);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    public function send_reservation_image(Request $request){
        try{

               //validation

               $rules = [
                "reservation_id" => "required|exists:reservations,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $reservation = Reservation::whereId($request->reservation_id)->first();



             $data = [];

            if ($request->receipt_image) {
            $data["receipt_image"] = upload_image($request->receipt_image, "docotrs");
            }
            if ($request->receipt_code) {
            $data["receipt_code"] = $request->receipt_code;

             }
             $reservation->update($data);

                
            $msg = "تم  الارسال بنجاح";

            $data = new ReservationResource($reservation);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
