<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\SettingResource;
use App\Models\Setting\Setting;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiTrait;

    public function fetch_setting(){
        try{
    
            
            $setting = Setting::firstOrNew();

            //response
            $data =  new SettingResource($setting);

            $msg = "fetch_setting";

            return $this->dataResponse($msg, $data,200);
    
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    
       }
}
