<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\UserResource;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Validator;
class RegisterController extends Controller
{
    use ApiTrait;
    public function register(Request $request){
       try { 

            $rules = [
              "name" => "required",
               "email" => "required|email|unique:users,email",
               "phone" => "sometimes|unique:users,phone",
               'password' => 'required|min:8',

           ];
           $validator = Validator::make($request->all(), $rules);
       
           if ($validator->fails()) {
      
               return $this->getvalidationErrors($validator);
               
           }
         
           $data = $validator->validated(); 

         
          $data["api_token"] = Hash::make(rand(1000,999999999));
          $data["password"] = Hash::make($request->password);
           $user = User::create($data);

               //response
               
               $msg = __('messages.register successfully');
               return $this->dataResponse($msg, new UserResource($user));
         

      
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }public function token_invalid()
    {
        //response
        $msg = 'من فضلك قم بتسجيل الدخول';
        return $this->errorResponse($msg, 401);

    }
}
