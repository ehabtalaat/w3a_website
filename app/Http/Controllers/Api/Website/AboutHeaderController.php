<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AboutHeaderResource;
use App\Models\AboutHeader\AboutHeader;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class AboutHeaderController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $about_header = AboutHeader::firstOrNew();

            //response

          
            
            $msg = "fetch_about_header";
            $data = new AboutHeaderResource($about_header);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
