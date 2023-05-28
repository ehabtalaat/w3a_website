<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\PaymentMethodResource;
use App\Models\PaymentMethod\PaymentMethod;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;

class PaymentMethodController extends Controller
{
    use ApiTrait;
    public function Index(Request $request)
    {
        try {
            $rules = [
                "offline" => "required|in:0,1"
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator, 422);
            }
            if ($request->offline == 1) {

                $payment_methods = PaymentMethod::orderBy("id", "desc")->offline()->get();
            } else {
                $payment_methods = PaymentMethod::orderBy("id", "desc")->online()->get();
            }

            //response

            $msg = "fetch_payment_methods";
            $data =  PaymentMethodResource::collection($payment_methods);

            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
