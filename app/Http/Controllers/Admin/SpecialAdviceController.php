<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SpecialAdvice\UpdateRequest;
use App\Models\SpecialAdvice\SpecialAdvice;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SpecialAdviceController extends Controller
{
    protected $view = 'admin_dashboard.special_advices.';
    protected $route = 'special_advices.';

    public function __construct()
    {
        $this->middleware(['permission:special_advices-update'])->only('update');
    }
    public function index()
    {
        $special_advice = SpecialAdvice::firstOrNew();
        return view($this->view . 'index', compact('special_advice'));
    }

    
    public function update(UpdateRequest $request)
    {
        $special_advice = SpecialAdvice::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $special_advice->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $special_advice->image ? delete_image($special_advice->image->image) : null;
            $data_image["image"] = upload_image($request->image, "special_advices");
        }


        //save image 
        $special_advice->image()->updateOrCreate([
            "imageable_id" => $special_advice->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
