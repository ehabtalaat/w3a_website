<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AboutPodcastResource;
use App\Http\Resources\Website\PodcastResource;
use App\Models\AboutPodcast\AboutPodcast;
use App\Models\Podcast\Podcast;
use App\Traits\ApiTrait; 
use Illuminate\Http\Request;
use Validator;
class podcastController extends Controller
{
    use ApiTrait;
    public function fetch_home_podcasts(){
        try{ 
            
            $about_podcast = AboutPodcast::firstOrNew();

            //response

          
            
            $msg = "fetch_home_podcasts";
            $data = new AboutPodcastResource($about_podcast);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_podcasts(){
        try{ 
            
            $mostlistened_podcasts = Podcast::mostlistened()->paginate(10);

            $podcasts = Podcast::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_home_podcasts";
            $data["mostlistened_podcasts"] = PodcastResource::collection($mostlistened_podcasts);
            $data["podcasts"] = PodcastResource::collection($podcasts);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_podcast_details(Request $request){
        try{

               //validation

               $rules = [
                "podcast_id" => "required|exists:podcasts,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $podcast = Podcast::whereId($request->podcast_id)->first();

             $podcasts = Podcast::where("id","!=",$podcast->id)->paginate(3);


                
            $msg = "fetch_podcast_details";

            $data["details"] = new  PodcastResource($podcast);
            $data["other_podcasts"] =  PodcastResource::collection($podcasts);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
