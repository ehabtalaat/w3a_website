<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AboutPodcastResource;
use App\Models\AboutPodcast\AboutPodcast;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

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
}
