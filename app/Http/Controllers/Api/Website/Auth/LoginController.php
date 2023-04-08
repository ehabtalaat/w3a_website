<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\UserResource;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Validator;
class LoginController extends Controller
{
    use ApiTrait;
    public function login(Request $request){
        try { 

            $rules = [
               "email" => "required",
               'password' => 'required',

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

         
           if (auth()->attempt($request->only(['email', 'password']))) {

          
              
           
            $user->update(["api_token" => Hash::make(rand(1000,999999999))]);
            
               //response
               
               $msg = __('messages.Logged in successfully');
               return $this->dataResponse($msg, new UserResource($user));
           }
            else {
                $msg = __('messages.The password is wrong');
               return $this->errorResponse($msg, 401);
           }

      
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
