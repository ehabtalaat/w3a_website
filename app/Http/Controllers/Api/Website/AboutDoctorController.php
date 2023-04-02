<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AboutDoctorResource;
use App\Models\AboutDoctor\AboutDoctor;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class AboutDoctorController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $about_doctor = AboutDoctor::firstOrNew();

            //response

          
            
            $msg = "fetch_about_doctor";
            $data = new AboutDoctorResource($about_doctor);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
