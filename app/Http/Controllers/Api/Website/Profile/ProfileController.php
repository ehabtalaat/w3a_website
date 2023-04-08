<?php

namespace App\Http\Controllers\Api\Website\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use  App\Traits\ApiTrait;
use App\Http\Resources\Website\UserResource;
use App\Models\User\User;
class ProfileController extends Controller
{
    use ApiTrait;
    public function update_profile(Request $request)
    {
        try {

            $user = auth()->user();
            //validation

            $rules = [
                "name" => "required",
                "phone" => "required|unique:users,phone,".$user->id,
                "email" => "required|email|unique:users,email,".$user->id,
                "age" => "numeric",
                "gender" => "sometimes",
                "chronic_diseases" => "sometimes",
                'image' => 'sometimes'

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            
            $user = auth()->user();

            $data["name"] = $request->name;
            $data["phone"] = $request->phone;
            $data["email"] = $request->email;
            $data["gender"] = $request->gender;
            $data["chronic_diseases"] = $request->chronic_diseases;
            $data["age"] = $request->age;

            $user->update($data);


            
        if ($request->image) {
            $user->image ? delete_image($user->image->image) : null;
            $data_image["image"] = upload_image($request->image, "users");
            
            $user->image()->updateOrCreate([
                "imageable_id" => $user->id
            ],$data_image);
        }

        //save image 


      

            //response

            $msg = __('messages.save successful');

            return $this->dataResponse($msg, new UserResource($user),200);

           
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
    public function fetch_profile()
    {
        try {

     
            
            $user = auth()->user();

           

            //response

            $msg = "fetch_profile";

            return $this->dataResponse($msg, new UserResource($user),200);

           
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
