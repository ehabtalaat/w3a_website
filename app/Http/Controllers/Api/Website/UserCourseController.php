<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CourseResource;
use App\Models\Course\Course;
use App\Models\User\UserCourse;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
class UserCourseController extends Controller
{
    use ApiTrait;
  
    public function buy(Request $request){
        try{

               //validation

               $rules = [
                "course_id" => "required|exists:courses,id",
                "payment_method_id" => "required|exists:payment_methods,id",
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }


             $user =  auth()->user();

             $course = Course::whereId($request->course_id)->first();

             $data["course_id"] = $course->id;
             $data["price"] = $course->price;
             $data["user_id"] = $user->id;
             $data["payment_method_id"] = $request->payment_method_id;


             UserCourse::create($data);
                
            $msg = "تمت عمليه الشراء بنجاح";


            return $this->successResponse($msg,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }

    public function index(){
        try{ 
            
            $user = auth()->user();
            $courses = $user->courses;

            //response

          
            
            $msg = "your_courses";
            $data =  CourseResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
   
}
