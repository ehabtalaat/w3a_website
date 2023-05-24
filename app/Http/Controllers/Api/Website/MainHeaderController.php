<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\MainHeaderResource;
use App\Models\MainHeader\MainHeader;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
class MainHeaderController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $main_header = MainHeader::get();

            //response

          
            
            $msg = "fetch_main_header";
            $data =  MainHeaderResource::collection($main_header);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
