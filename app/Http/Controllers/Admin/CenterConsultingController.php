<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CenterConsulting\UpdateRequest;
use App\Models\CenterConsulting\CenterConsulting;
use App\Models\CenterConsulting\CenterConsultingFeature;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CenterConsultingController extends Controller
{
    protected $view = 'admin_dashboard.center_consultings.';
    protected $route = 'center_consultings.';

    public function __construct()
    {
        $this->middleware(['permission:center_consultings-update'])->only('update');
    }
    public function index()
    {
        $center_consulting = CenterConsulting::firstOrNew();
        return view($this->view . 'index', compact('center_consulting'));
    }

    
    public function update(UpdateRequest $request)
    {
        $center_consulting = CenterConsulting::firstOrCreate();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $center_consulting->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $center_consulting->image ? delete_image($center_consulting->image->image) : null;
            $data_image["image"] = upload_image($request->image, "center_consultings");
        }


        //save image 
        $center_consulting->image()->updateOrCreate([
            "imageable_id" => $center_consulting->id
        ],$data_image);

        foreach( $center_consulting->features as $feature){
      $feature->image ? delete_image($feature->image->image) : null;
      $feature->image->delete();

        }

        $center_consulting->features()->delete();

        //save features
        $count = 0;
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $count = $request['titles-' . $localeCode] ? count($request['titles-' . $localeCode]) : 0;
         }
        for($i = 0;$i < $count;$i++) {
         foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
             $data_title[$localeCode] = ['title' => $request['titles-' . $localeCode][$i],
             'text' => $request['texts-' . $localeCode][$i],
         ];
            }
            $data_title['center_consulting_id'] = $center_consulting->id;
           $center_consulting_feature =  CenterConsultingFeature::create($data_title);

            $feature_image = [];

            if ($request->images && array_key_exists($i,$request->images)) {
                $feature_image["image"] = upload_image($request->images[$i], "center_consultings");
            }
    
    
            //save image 
            $center_consulting_feature->image()->updateOrCreate([
                "imageable_id" => $center_consulting_feature->id
            ],$feature_image);
         }


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
