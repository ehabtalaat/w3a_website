<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\ExperienceResource;
use App\Http\Resources\Website\StoreHeaderResource;
use App\Http\Resources\Website\WebsiteReasonResource;
use App\Models\Experience\Experience;
use App\Models\StoreHeader\StoreHeader;
use App\Models\WebsiteReason\WebsiteReason;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use ApiTrait;
    public function fetch_store_header(){
        try{ 
            
            $store_header = StoreHeader::firstOrNew();

            //response

          
            
            $msg = "fetch_store_header";
            $data = new StoreHeaderResource($store_header);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_website_reasons(){
        try{ 
            
            $website_reasons = WebsiteReason::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_website_reasons";
            $data =  WebsiteReasonResource::collection($website_reasons);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_website_expeienses(){
        try{ 
            
            $experiences = Experience::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_website_expeienses";
            $data =  ExperienceResource::collection($experiences);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
