<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\PodcastResource;
use App\Models\Podcast\Podcast;
use App\Models\User\UserPodcast;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
class UserPodcastController extends Controller
{
    use ApiTrait;
  
    public function buy(Request $request){
        try{

               //validation

               $rules = [
                "podcast_id" => "required|exists:podcasts,id",
                "payment_method_id" => "required|exists:payment_methods,id",
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }


             $user =  auth()->user();

             $podcast = Podcast::whereId($request->podcast_id)->first();

             $data["podcast_id"] = $podcast->id;
             $data["price"] = $podcast->price;
             $data["user_id"] = $user->id;
             $data["payment_method_id"] = $request->payment_method_id;


             UserPodcast::create($data);
                
            $msg = "تمت عمليه الشراء بنجاح";


            return $this->successResponse($msg,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }

    public function index(){
        try{ 
            
            $user = auth()->user();
            $courses = $user->podcasts;

            //response

          
            
            $msg = "your_podcasts";
            $data =  PodcastResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

   
}
