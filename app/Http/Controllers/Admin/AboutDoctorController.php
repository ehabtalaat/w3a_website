<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainHeader\UpdateRequest;
use App\Models\MainHeader\MainHeader;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MainHeaderController extends Controller
{
    protected $view = 'admin_dashboard.main_headers.';
    protected $route = 'main_headers.';

    public function index()
    {
        $main_header = MainHeader::firstOrNew();
        return view($this->view . 'index', compact('main_header'));
    }

    
    public function update(UpdateRequest $request)
    {
        $main_header = MainHeader::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $main_header->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $main_header->image ? delete_image($main_header->image->image) : null;
            $data_image["image"] = upload_image($request->image, "main_headers");
        }


        //save image 
        $main_header->image()->updateOrCreate([
            "imageable_id" => $main_header->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
