<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteText\UpdateRequest;
use App\Models\WebsiteText\WebsiteText;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebsiteTextController extends Controller
{
    protected $view = 'admin_dashboard.website_texts.';
    protected $route = 'website_texts.';

    public function index()
    {
        $website_text = WebsiteText::firstOrNew();
        return view($this->view . 'index', compact('website_text'));
    }

    
    public function update(Request $request)
    {
        $website_text = WebsiteText::firstOrCreate();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['features_text' => $request['features_text-' . $localeCode],
                                 'courses_text' => $request['courses_text-' . $localeCode],
                                 'store_text' => $request['store_text-' . $localeCode],
                                 'doctors_text' => $request['doctors_text-' . $localeCode],
                                 'blog_text' => $request['blog_text-' . $localeCode],
                                 'brief_text' => $request['brief_text-' . $localeCode],
                                 'website_reasons_text' => $request['website_reasons_text-' . $localeCode],
                                 'experiences_text' => $request['experiences_text-' . $localeCode],
          ];
        }
        
        $website_text->update($data);


        return redirect()->back()
        ->with(['success'=> __("messages.editmessage")]);

    }
}
