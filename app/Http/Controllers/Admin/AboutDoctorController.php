<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutDoctor\UpdateRequest;
use App\Models\AboutDoctor\AboutDoctor;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AboutDoctorController extends Controller
{
    protected $view = 'admin_dashboard.about_doctors.';
    protected $route = 'about_doctors.';

    public function __construct()
    {
        $this->middleware(['permission:about_doctors-update'])->only('update');
    }

    public function index()
    {
        $about_doctor = AboutDoctor::firstOrNew();
        return view($this->view . 'index', compact('about_doctor'));
    }

    
    public function update(UpdateRequest $request)
    {
        $about_doctor = AboutDoctor::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $about_doctor->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $about_doctor->image ? delete_image($about_doctor->image->image) : null;
            $data_image["image"] = upload_image($request->image, "about_doctors");
        }


        //save image 
        $about_doctor->image()->updateOrCreate([
            "imageable_id" => $about_doctor->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
