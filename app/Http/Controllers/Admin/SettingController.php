<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateRequest;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingController extends Controller
{
    protected $view = 'admin_dashboard.settings.';
    protected $route = 'settings.';

    public function index()
    {
        $setting = Setting::firstOrNew();
        return view($this->view . 'index', compact('setting'));
    }

    
    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate();
     
        
        $data['phone']=$request->phone;
        $data['whatsapp']=$request->whatsapp;
        $data['email']=$request->email;
        $data['twitter']=$request->twitter;
        $data['facebook']=$request->facebook;
        $data['linkedin']=$request->linkedin;
        $data['instagram']=$request->instagram;
        $data['website']=$request->website;
        $data['youtube']=$request->youtube;
        
        $setting->update($data);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}//end
