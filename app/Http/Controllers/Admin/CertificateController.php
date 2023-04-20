<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Certificate\UpdateRequest;
use App\Models\Certificate\Certificate;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CertificateController extends Controller
{
    protected $view = 'admin_dashboard.certificates.';
    protected $route = 'certificates.';

    // public function __construct()
    // {
    //     $this->middleware(['permission:about_headers-update'])->only('update');
    // }

    public function index()
    {
        $certificate = Certificate::firstOrNew();
        return view($this->view . 'index', compact('certificate'));
    }

    
    public function update(UpdateRequest $request)
    {
        $certificate = Certificate::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $certificate->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $certificate->image ? delete_image($certificate->image->image) : null;
            $data_image["image"] = upload_image($request->image, "certificates");
        }


        //save image 
        $certificate->image()->updateOrCreate([
            "imageable_id" => $certificate->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
