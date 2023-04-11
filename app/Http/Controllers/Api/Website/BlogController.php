<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BlogResource;
use App\Models\Blog\Blog;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
class BlogController extends Controller
{
    use ApiTrait;
    public function fetch_home_blogs(){
        try{ 
            
            $blogs = Blog::orderBy("id","desc")->paginate(4);

            //response

          
            
            $msg = "fetch_home_blogs";
            $data =  BlogResource::collection($blogs);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_blogs(){
        try{ 
            
            $blogs = Blog::orderBy("id","desc")->paginate(6);

            //response

          
            
            $msg = "fetch_blogs";
            $data =  BlogResource::collection($blogs)->response()->getData(true);;

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function blog_details(Request $request){
        try{

               //validation

               $rules = [
                "blog_id" => "required|exists:blogs,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $blog = Blog::whereId($request->blog_id)->first();

             $blogs = Blog::where("id","!=",$blog->id)->paginate(3);


                
            $msg = "fetch_book_details";

            $data["details"] = new  BlogResource($blog);
            $data["similar_blogs"] =  BlogResource::collection($blogs);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
