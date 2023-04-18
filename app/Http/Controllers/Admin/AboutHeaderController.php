<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutHeader\UpdateRequest;
use App\Models\AboutHeader\AboutHeader;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AboutHeaderController extends Controller
{
    protected $view = 'admin_dashboard.about_headers.';
    protected $route = 'about_headers.';

    public function __construct()
    {
        $this->middleware(['permission:about_headers-update'])->only('update');
    }

    public function index()
    {
        $about_header = AboutHeader::firstOrNew();
        return view($this->view . 'index', compact('about_header'));
    }

    
    public function update(UpdateRequest $request)
    {
        $about_header = AboutHeader::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $about_header->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $about_header->image ? delete_image($about_header->image->image) : null;
            $data_image["image"] = upload_image($request->image, "about_headers");
        }


        //save image 
        $about_header->image()->updateOrCreate([
            "imageable_id" => $about_header->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
