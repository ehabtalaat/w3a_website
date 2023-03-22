<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TagDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Tag\Tag;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TagController extends Controller
{
    protected $view = 'admin_dashboard.tags.';
    protected $route = 'tags.';


    public function index(TagDataTable $dataTable)
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
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
          ];
        }
  
        //create
       $tag = Tag::create($data);

    

     

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $tag = Tag::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('tag'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $tag = Tag::whereId($id)->first();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' => $request['title-' . $localeCode],
          ];
        }
      
        //update
        
        $tag->update($data);

      
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $tag = Tag::whereId($id)->first();

        //delete
        $tag->delete();
        return response()->json(['status' => true]);

    }
}
