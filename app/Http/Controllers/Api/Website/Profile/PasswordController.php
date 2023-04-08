<?php

namespace App\Http\Controllers\Api\Website\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use  App\Traits\ApiTrait;
use App\Http\Resources\Website\UserResource;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
class PasswordController extends Controller
{
    use ApiTrait;
    public function change_password(Request $request)
    {
        try {

            //validation

            $rules = [
                "old_password" => "required|min:8",
                "new_password" => "required|min:8",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            
            $user = auth()->user();

            //check if old password and new password if the same

            if (Hash::check($request->old_password, auth()->user()->password)) {

                $user->update([

                    'password' => Hash::make($request->new_password),
                ]);

                //response

                $msg = __('messages.Password has been changed successfully');

                return $this->dataResponse($msg, new UserResource($user),200);

            } else {

                $msg = __('messages.The old password does not match the user password');

                return $this->errorResponse($msg, 401);
            }
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
