<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\UserResource;
use App\Models\User\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator; 

class PasswordController extends Controller
{
    use ApiTrait;
   
    public function reset_password(Request $request){
        try { 
                        
            $rules = [
                "email" => "required|email",
                "password" => "required|min:8",
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
                    'password' => hash_user_password($request->password),
                ]);

                $msg = __('messages.Password has been changed successfully');
                return $this->dataResponse($msg, new UserResource($user), 200);
      
               
               
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
