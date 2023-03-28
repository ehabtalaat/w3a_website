<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\LessonDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Course\Lesson;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class LessonController extends Controller
{
    protected $view = 'admin_dashboard.lessons.';
    protected $route = 'lessons.';

  
    public function index(LessonDataTable $dataTable, $id)
    {
        $dataTable->id = $id;
        $course = Course::whereId($id)->firstOrFail();
        return $dataTable->render($this->view . 'index', ["course" => $course]);
    }

    public function create($id)
    {
        $course = Course::whereId($id)->firstOrFail();

        return view($this->view . 'create', compact("course"));
    }

    public function store(Request $request, $id)
    {

        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['text-' . $localeCode] = ['sometimes',
            ];
        }
        $rules["video"] = ["required", "mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,mkv"];
        $rules["image"] = ["required", "mimes:jpeg,jpg,png,gif"];

        $validator = Validator::make($request->all(), $rules, [
            'video.mimes' => 'هذا الحقل يقبل فيديو فقط',
            'image.mimes' => 'هذا الحقل يقبل صوره فقط',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }

        $course = Course::whereId($id)->firstOrFail();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }

        $data["course_id"] = $id;

        if ($request->hasFile('video')) {
            $data["video"] = upload_video($request->video, "lessons");
        }

       
        $lesson = Lesson::create($data);


        
        $data_image = [];

        //update image
 
        if ($request->hasFile('image')) {
            $data_image["image"] = upload_image($request->image, "lessons");
        }
 
 
        //save image 
        $lesson->image()->create($data_image);

        $message = __("messages.createmessage");
        return response()->json(["status" => true, "message" => $message, "course_id" => $lesson->course_id]);
    }

    public function edit($id)
    {
        $lesson = Lesson::whereId($id)->firstOrFail();

        return view($this->view . 'edit', compact("lesson"));
    }

    public function update(Request $request, $id)
    {
        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['text-' . $localeCode] = ['sometimes',
            ];
        }
        // $rules["video"] = ["sometimes", "mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,mkv"];

        $validator = Validator::make($request->all(), $rules, [
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }

        $lesson = Lesson::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }

        if ($request->hasFile('video')) {
            $lesson->video ? delete_image($lesson->video) : "";

            $data["video"] = upload_video($request->video, "lessons");
        }

        
        $lesson->update($data);


        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $lesson->image ? delete_image($lesson->image->image) : null;
            $data_image["image"] = upload_image($request->image, "lessons");
        }


        //save image 
        $lesson->image()->updateOrCreate([
            "imageable_id" => $lesson->id
        ],$data_image);
        $message = __("messages.editmessage");
        return response()->json(["status" => true, "message" => $message, "course_id" => $lesson->course_id]);
    }

    public function destroy($id)
    {
        $lesson = Lesson::whereId($id)->first();

        $lesson->video ? delete_image($lesson->video) : "";

        $lesson->image ? delete_image($lesson->image->image) : null;


        $lesson->delete();

        return response()->json(['status' => true]);
    }
}
