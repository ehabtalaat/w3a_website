<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Day\Day;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorDay;
use App\Models\Doctor\DoctorDayTime;
use Illuminate\Http\Request;

class OffLineTimeController extends Controller
{
    protected $view = 'admin_dashboard.doctors.times.';
    protected $route = 'doctors.';

    public function index($id)
    {
        $doctor = Doctor::whereId($id)->firstorFail();
        $days = Day::get();
 
        return view($this->view . 'offline_index', compact("doctor","days"));
    }
    public function update(Request $request,$id){

        $days = Day::get();

        $day_ids = $request->day_ids;
        if(!$day_ids){
            DoctorDay::where("doctor_id",$id)->update([
                "active" => 0
            ]); 
            $doctor_days_ids = DoctorDay::where("doctor_id",$id)->get()->pluck("id")->toArray();
            
            DoctorDayTime::whereIn("doctor_day_id",$doctor_days_ids)->whereOffline(1)->update([
                "active" => 0
                       ]);
        }
        if($day_ids){
        foreach ($day_ids as $day_id) {
            $data["day_id"] = $day_id;
            $data["doctor_id"] = $id;
            $udpate_data = $data;
            $udpate_data["active"] = 1;
            $udpate_data["offline"] = 1;

            //create or update day for Doctor
            $doctor_day = DoctorDay::updateOrCreate($data, $udpate_data);
            
            if(!in_array($day_id,$days->pluck("id")->toArray())){
                $doctor_day->update([
                    "active" => 0
                ]);
            }
            DoctorDayTime::where("doctor_day_id", $doctor_day->id)->update([
             "active" => 0
                    ]);
            //assign time for Doctor day
            if (array_key_exists($day_id, $request->from_time)) {
                foreach ($request->from_time[$day_id] as $key => $from_time) {
                    $to_time = $request->to_time;


                    $time_data["day_id"] = $day_id;

                    $time_data["doctor_day_id"] = $doctor_day->id;

                    $time_data["from_time"] = $from_time;

                    $time_data["to_time"] = $to_time[$day_id][$key];


                    DoctorDayTime::create($time_data);
                }
            }
        }
    }
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    
    }

}
