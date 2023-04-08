<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Website\UserResource;
use App\Traits\ApiTrait;
use App\Models\User\User;
use Validator;
class CheckCodeController extends Controller
{
    use ApiTrait;
    public function check_code(Request $request){
        try { 
                        
            $rules = [
                "email" => "required|email",
                "code" => "required",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            
            $user = User::whereEmail($request->email)->first();

            //check if user exists

            if (!$user) {
                $msg = __('messages.Sorry, this user does not exist');
                return $this->errorResponse($msg, 200);
             } 

            $code = $request->code;

            if($code != $user->code){

                $msg = __('messages.Sorry, this code is not correct');

                return $this->errorResponse($msg, 200);
                 
            } 
            
            $msg = __('messages.code confirmed successfully');
            return $this->dataResponse($msg, new UserResource($user));
               
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    
}
