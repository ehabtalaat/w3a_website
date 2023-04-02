<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CourseResource;
use App\Models\Course\Course;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiTrait;
    public function index(){
        try{ 
            
            $courses = Course::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_home_courses";
            $data =  CourseResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
