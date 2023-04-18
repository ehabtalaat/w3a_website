<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PodcastDataTable;
use App\Http\Controllers\Controller;
use App\Models\Podcast\Podcast;
use App\Models\Tag\Tag;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class PodcastController extends Controller
{
    protected $view = 'admin_dashboard.podcasts.';
    protected $route = 'podcasts.';

    public function __construct()
    {
        $this->middleware(['permission:podcasts-create'])->only('create');
        $this->middleware(['permission:podcasts-read'])->only('index');
        $this->middleware(['permission:podcasts-update'])->only('edit');
        $this->middleware(['permission:podcasts-delete'])->only('destroy');
    }

    public function index(PodcastDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    public function create()
    {
        $tags = Tag::get();

        return view($this->view . 'create',compact("tags"));
    }

    public function store(Request $request)
    {

        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as
            $localeCode => $properties) {
            $rules['title-' . $localeCode] = ['required',
            ];
            $rules['text-' . $localeCode] = ['sometimes',
            ];
        }
        $rules["audio"] = ["required", "mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav"];
        $rules["image"] = ["required", "mimes:jpeg,jpg,png,gif"];

        $validator = Validator::make($request->all(), $rules, [
            'audio.mimes' => 'هذا الحقل يقبل صوت فقط',
            'image.mimes' => 'هذا الحقل يقبل صوره فقط',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }


        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }

        

        if ($request->hasFile('audio')) {
            $getID3 = new \getID3;

        $file = $getID3->analyze($request->file('audio'));

        $data["mintues"] = round($file['playtime_seconds']/60,1);

            $data["audio"] = upload_video($request->audio, "podcasts");
        }

      
        $data["price"] = $request->price;

        $podcast = Podcast::create($data);

        $podcast->tags()->attach($request->tag_ids);


        $data_image = [];

        //update image
 
        if ($request->hasFile('image')) {
            $data_image["image"] = upload_image($request->image, "podcasts");
        }
 
 
        //save image 
        $podcast->image()->create($data_image);
    
        

        $message = __("messages.createmessage");
        return response()->json(["status" => true, "message" => $message]);
    }

    public function edit($id)
    {
        $podcast = Podcast::whereId($id)->firstOrFail();

        $tags = Tag::get();

        return view($this->view . 'edit', compact("podcast","tags"));
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
        // $rules["audio"] = ["sometimes", "mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msaudio,x-ms-wmv,mkv"];

        $validator = Validator::make($request->all(), $rules, [
            'mimetypes' => 'هذا الحقل يقبل صوت فقط',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }

        $podcast = Podcast::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $request['title-' . $localeCode],

                'text' => $request['text-' . $localeCode],
            ];
        }

        if ($request->hasFile('audio')) {
            $getID3 = new \getID3;

            $file = $getID3->analyze($request->file('audio'));
    
            $data["mintues"] = round($file['playtime_seconds']/60,1);
            $podcast->audio ? delete_image($podcast->audio) : "";

            $data["audio"] = upload_video($request->audio, "podcasts");
        }

        $data["price"] = $request->price;

     
        $podcast->update($data);

        $podcast->tags()->sync($request->tag_ids);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $podcast->image ? delete_image($podcast->image->image) : null;
            $data_image["image"] = upload_image($request->image, "podcasts");
        }


        //save image 
        $podcast->image()->updateOrCreate([
            "imageable_id" => $podcast->id
        ],$data_image);


        // return redirect()->route($this->route . "index", ["id" => $podcast->part_id])
        //     ->with(['success' => __("messages.editmessage")]);
        $message = __("messages.editmessage");
        return response()->json(["status" => true, "message" => $message]);
    }

    public function destroy($id)
    {
        $podcast = Podcast::whereId($id)->first();

        $podcast->audio ? delete_image($podcast->audio) : "";

        $podcast->image ? delete_image($podcast->image->image) : null;

        $podcast->delete();

        return response()->json(['status' => true]);
    }
}
