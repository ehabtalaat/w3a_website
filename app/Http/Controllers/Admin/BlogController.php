<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogController extends Controller
{
    protected $view = 'admin_dashboard.blogs.';
    protected $route = 'blogs.';

    public function __construct()
    {
        $this->middleware(['permission:blogs-create'])->only('create');
        $this->middleware(['permission:blogs-read'])->only('index');
        $this->middleware(['permission:blogs-update'])->only('edit');
        $this->middleware(['permission:blogs-delete'])->only('destroy');
    }

    public function index(BlogDataTable $dataTable)
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
  
       $blog = Blog::create($data);

    
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "blogs");
       }


       //save image 
       $blog->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);    
    }

    
    public function edit($id)
    {
        $blog = Blog::whereId($id)->firstOrFail();
        return view($this->view . 'edit' , compact('blog'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $blog = Blog::whereId($id)->first();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['text' => $request['text-' . $localeCode],
                                    'title' => $request['title-' . $localeCode],
          ];
        }
      
        
        $blog->update($data);

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $blog->image ? delete_image($blog->image->image) : null;
            $data_image["image"] = upload_image($request->image, "blogs");
        }


        //save image 
        $blog->image()->updateOrCreate([
            "imageable_id" => $blog->id
        ],$data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $blog = Blog::whereId($id)->first();
        $blog->image ? delete_image($blog->image->image) : null;

        $blog->delete();
        return response()->json(['status' => true]);

    }
}
