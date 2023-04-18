<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutPodcast\UpdateRequest;
use App\Models\AboutPodcast\AboutPodcast;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AboutPodcastController extends Controller
{
    protected $view = 'admin_dashboard.about_podcasts.';
    protected $route = 'about_podcasts.';

    public function __construct()
    {
        $this->middleware(['permission:about_podcasts-update'])->only('update');
    }

    public function index()
    {
        $about_podcast = AboutPodcast::firstOrNew();
        return view($this->view . 'index', compact('about_podcast'));
    }

    
    public function update(UpdateRequest $request)
    {
        $about_podcast = AboutPodcast::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $about_podcast->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $about_podcast->image ? delete_image($about_podcast->image->image) : null;
            $data_image["image"] = upload_image($request->image, "about_podcasts");
        }


        //save image 
        $about_podcast->image()->updateOrCreate([
            "imageable_id" => $about_podcast->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
