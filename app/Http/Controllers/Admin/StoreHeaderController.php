<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHeader\UpdateRequest;
use App\Models\StoreHeader\StoreHeader;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreHeaderController extends Controller
{
    protected $view = 'admin_dashboard.store_headers.';
    protected $route = 'store_headers.';

    public function __construct()
    {
        $this->middleware(['permission:store_headers-update'])->only('update');
    }

    public function index()
    {
        $store_header = StoreHeader::firstOrNew();
        return view($this->view . 'index', compact('store_header'));
    }

    
    public function update(UpdateRequest $request)
    {
        $store_header = StoreHeader::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
                                 'text' => $request['text-' . $localeCode],
          ];
        }
      
        $store_header->update($data);

        $data_image = [];

        if ($request->hasFile('image')) {
            $store_header->image ? delete_image($store_header->image->image) : null;
            $data_image["image"] = upload_image($request->image, "store_headers");
        }


        //save image 
        $store_header->image()->updateOrCreate([
            "imageable_id" => $store_header->id
        ],$data_image);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
