<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\TimeResource;
use App\Models\Doctor\DoctorDay;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
class TimeController extends Controller
{
    use ApiTrait;
    public function filter_doctor_times_by_date(Request $request){
        try{   
            $rules = [
                "doctor_id" => "required|exists:doctors,id",
                "date" => "required",
                "contact_type" => "required|numeric|min:1|max:2",
            ];
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return $this->getvalidationErrors($validator,422);
            }

        $doctor_id = $request->doctor_id;
        $date = $request->date;
        $offline = $request->contact_type == 2 ? 0 : 1;

        $day_of_week = Carbon::parse($date)->dayOfWeek;
        $doctor_day = DoctorDay::whereHas('day',function($q) use($day_of_week){
            return $q->where('day_of_week',$day_of_week);
        })->where('doctor_id',$doctor_id)->whereActive(1)->whereOffline($offline)->first();

        $times = $doctor_day->times ?? [];

            //response
            $data = TimeResource::collection($times);

            $msg = "filter_doctor_times_by_date";
            return $this->dataResponse($msg, $data,200);
        
        
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
