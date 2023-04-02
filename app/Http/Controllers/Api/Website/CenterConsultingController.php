<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CenterConsultingResource;
use App\Models\CenterConsulting\CenterConsulting;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class CenterConsultingController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $center_consulting = CenterConsulting::firstOrNew();

            //response

          
            
            $msg = "fetch_center_consulting";
            $data = new CenterConsultingResource($center_consulting);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
