<?php

namespace App\Http\Controllers\Api\Website\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiTrait;
    public function logout(){
        try { 

          $user = auth()->user();
           
             $user->update(["api_token" => null]);
            
               //response
               
               $msg = __('messages.Signed out successfully');
               return $this->successResponse($msg, 200);
         
      

      
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
}
}