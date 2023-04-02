<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\FeatureResource;
use App\Models\Feature\Feature;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $features = Feature::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_features";
            $data =  FeatureResource::collection($features);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
