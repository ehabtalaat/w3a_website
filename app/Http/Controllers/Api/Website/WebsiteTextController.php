<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\WebsiteTextResource;
use App\Models\WebsiteText\WebsiteText;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class WebsiteTextController extends Controller
{
    use ApiTrait;
    public function fetch_website_texts(){

        try{
    
            $website_text = WebsiteText::firstOrNew();

            //response
            $data =  new WebsiteTextResource($website_text);

            $msg = "fetch_website_texts";

            return $this->dataResponse($msg, $data,200);
    
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    
}
