<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ExperienceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Experience\StoreRequest;
use App\Http\Requests\Admin\Experience\UpdateRequest;
use App\Models\Experience\Experience;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExperienceController extends Controller
{
    protected $view = 'admin_dashboard.experiences.';
    protected $route = 'experiences.';


    public function index(ExperienceDataTable $dataTable)
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
  
       $experience = Experience::create($data);

    
      

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $experience = Experience::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('experience'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $experience = Experience::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        
        $experience->update($data);

   
      

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $experience = Experience::whereId($id)->first();

        $experience->delete();
        return response()->json(['status' => true]);

    }
}
