<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\PaymentMethodResource;
use App\Models\PaymentMethod\PaymentMethod;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    use ApiTrait;
    public function Index(){
        try{ 
            
            $payment_methods = PaymentMethod::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_payment_methods";
            $data =  PaymentMethodResource::collection($payment_methods);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
