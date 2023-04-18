<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\DoctorResource;
use App\Models\Doctor\Doctor;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ApiTrait;
    public function fetch_home_doctors(){
        try{ 
            
            $courses = Doctor::orderBy("id","desc")->doctor()->active()->paginate(4);

            //response

          
            
            $msg = "fetch_home_doctors";
            $data =  DoctorResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
    public function fetch_main_doctor(){
        try{ 
            
            $doctor = Doctor::whereMain(1)->first();

            //response

          
            
            $msg = "fetch_home_doctors";
            $data  = $doctor ? new  DoctorResource($doctor) : null;

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_doctors(){
        try{ 
            
            $doctors = Doctor::orderBy("id","desc")->doctor()->paginate(10);


            //response

            
            $msg = "fetch_doctors";
            $data =  DoctorResource::collection($doctors)->response()->getData(true);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
