<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PaymentMethodDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethod\StoreRequest;
use App\Http\Requests\Admin\PaymentMethod\UpdateRequest;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PaymentMethodController extends Controller
{
    protected $view = 'admin_dashboard.payment_methods.';
    protected $route = 'payment_methods.';


    public function __construct()
    {
        $this->middleware(['permission:payment_methods-create'])->only('create');
        $this->middleware(['permission:payment_methods-read'])->only('index');
        $this->middleware(['permission:payment_methods-update'])->only('edit');
        $this->middleware(['permission:payment_methods-delete'])->only('destroy');
    }
    public function index(PaymentMethodDataTable $dataTable)
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
  
        $data["code_required"] = $request->code_required ?  1 : 0;
        $data["image_required"] = $request->code_required ?  1 : 0;
       $payment_method = PaymentMethod::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "payment_methods");
       }


       //save image 
       $payment_method->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $payment_method = PaymentMethod::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('payment_method'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $payment_method = PaymentMethod::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
        $data["code_required"] = $request->code_required ?  1 : 0;
        $data["image_required"] = $request->code_required ?  1 : 0;
        
        $payment_method->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $payment_method->image ? delete_image($payment_method->image->image) : null;
            $data_image["image"] = upload_image($request->image, "payment_methods");
        }


        //save image 
        $payment_method->image()->updateOrCreate([
            "imageable_id" => $payment_method->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $payment_method = PaymentMethod::whereId($id)->first();
        $payment_method->image ? delete_image($payment_method->image->image) : null;

        $payment_method->delete();
        return response()->json(['status' => true]);

    }
}
