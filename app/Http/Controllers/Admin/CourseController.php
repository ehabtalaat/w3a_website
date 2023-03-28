<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CourseDataTable;
use App\DataTables\Admin\VideoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class CourseController extends Controller
{
    protected $view = 'admin_dashboard.courses.';
    protected $route = 'courses.';


    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    public function create()
    {

        return view($this->view . 'create');
    }

    public function store(Request $request)
    {

        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['features-' . $localeCode] = ['sometimes',
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


        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'features' => $request['features-' . $localeCode],
            ];
        }


        if ($request->hasFile('video')) {
            $data["video"] = upload_video($request->video, "courses");
        }

      
        $data["price"] = $request->price;

        $course = Course::create($data);


        $data_image = [];

        //update image
 
        if ($request->hasFile('image')) {
            $data_image["image"] = upload_image($request->image, "courses");
        }
 
 
        //save image 
        $course->image()->create($data_image);
    


        $message = __("messages.createmessage");
        return response()->json(["status" => true, "message" => $message]);
    }

    public function edit($id)
    {
        $course = Course::whereId($id)->firstOrFail();

        return view($this->view . 'edit', compact("course"));
    }

    public function update(Request $request, $id)
    {
        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['features-' . $localeCode] = ['sometimes',
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

        $course = Course::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'features' => $request['features-' . $localeCode],
            ];
        }

        if ($request->hasFile('video')) {
            $course->video ? delete_image($course->video) : "";

            $data["video"] = upload_video($request->video, "courses");
        }

        $data["price"] = $request->price;

     
        $course->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $course->image ? delete_image($course->image->image) : null;
            $data_image["image"] = upload_image($request->image, "courses");
        }


        //save image 
        $course->image()->updateOrCreate([
            "imageable_id" => $course->id
        ],$data_image);


        // return redirect()->route($this->route . "index", ["id" => $course->part_id])
        //     ->with(['success' => __("messages.editmessage")]);
        $message = __("messages.editmessage");
        return response()->json(["status" => true, "message" => $message]);
    }

    public function destroy($id)
    {
        $course = Course::whereId($id)->first();

        $course->video ? delete_image($course->video) : "";

        $course->image ? delete_image($course->image->image) : null;

        $course->delete();

        return response()->json(['status' => true]);
    }
}
