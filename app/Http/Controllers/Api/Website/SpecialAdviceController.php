<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\SpecialAdviceResource;
use App\Models\SpecialAdvice\SpecialAdvice;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class SpecialAdviceController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $special_advice = SpecialAdvice::firstOrNew();

            //response

          
            
            $msg = "fetch_special_advice";
            $data = new SpecialAdviceResource($special_advice);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
