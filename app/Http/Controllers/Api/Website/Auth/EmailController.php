<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\UserResource;
use App\Models\User\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator; 

class EmailController extends Controller
{
    use ApiTrait;
    public function check_email(Request $request){
        try { 
                        
            $rules = [
                "email" => "required|email",
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

            $user->update([
                'code' => 123456,
                ]);

                $msg = __('messages.The user was found successfully');
                return $this->dataResponse($msg, new UserResource($user));
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

   
}
