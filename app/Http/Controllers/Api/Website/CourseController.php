<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CourseResource;
use App\Http\Resources\Website\LessonResource;
use App\Models\Course\Course;
use App\Models\Course\Lesson;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
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

    public function fetch_educational_platform(){
        try{ 
            
            $courses = Course::orderBy("id","desc")->get();

            //response

          
            
            $msg = "fetch_educational_platform";
            $data =  CourseResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
    public function fetch_educational_platform_details(Request $request){
        try{

               //validation

               $rules = [
                "course_id" => "required|exists:courses,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $course = Course::whereId($request->course_id)->first();

             $courses = Course::where("id","!=",$course->id)->paginate(3);


                
            $msg = "fetch_educational_platform_details";

            $data["details"] = new  CourseResource($course);
            $data["other_courses"] =  CourseResource::collection($courses);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    public function fetch_course_lessons(Request $request){
        try{

               //validation

               $rules = [
                "course_id" => "required|exists:courses,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $course = Course::whereId($request->course_id)->first();



                
            $msg = "fetch_course_lessons";

            $data =  LessonResource::collection($course->lessons);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    public function fetch_lesson_details(Request $request){
        try{

               //validation

               $rules = [
                "lesson_id" => "required|exists:lessons,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $lesson = Lesson::whereId($request->lesson_id)->first();
             $lessons = Lesson::where([["course_id","=",$lesson->course_id],["id","!=",$lesson->id]])->get();



                
            $msg = "fetch_lesson_details";

            $data["details"] = new LessonResource($lesson);
            $data["other_lessons"] =  LessonResource::collection($lessons);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
