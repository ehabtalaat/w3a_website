<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WebsiteReasonDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteReason\StoreRequest;
use App\Http\Requests\Admin\WebsiteReason\UpdateRequest;
use App\Models\WebsiteReason\WebsiteReason;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebsiteReasonController extends Controller
{
    protected $view = 'admin_dashboard.website_reasons.';
    protected $route = 'website_reasons.';

    public function __construct()
    {
        $this->middleware(['permission:website_reasons-create'])->only('create');
        $this->middleware(['permission:website_reasons-read'])->only('index');
        $this->middleware(['permission:website_reasons-update'])->only('edit');
        $this->middleware(['permission:website_reasons-delete'])->only('destroy');
    }

    public function index(WebsiteReasonDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    
    public function create()
    {
        return view($this->view . 'create' );
    }

    
    public function store(StoreRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
  
       $website_reason = WebsiteReason::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "website_reasons");
       }


       //save image 
       $website_reason->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $website_reason = WebsiteReason::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('website_reason'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $website_reason = WebsiteReason::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        
        $website_reason->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $website_reason->image ? delete_image($website_reason->image->image) : null;
            $data_image["image"] = upload_image($request->image, "website_reasons");
        }


        //save image 
        $website_reason->image()->updateOrCreate([
            "imageable_id" => $website_reason->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $website_reason = WebsiteReason::whereId($id)->first();
        $website_reason->image ? delete_image($website_reason->image->image) : null;

        $website_reason->delete();
        return response()->json(['status' => true]);

    }
}
