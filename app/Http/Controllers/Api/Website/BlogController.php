<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BlogResource;
use App\Models\Blog\Blog;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiTrait;
    public function fetch_home_blogs(){
        try{ 
            
            $courses = Blog::orderBy("id","desc")->paginate(4);

            //response

          
            
            $msg = "fetch_home_blogs";
            $data =  BlogResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
