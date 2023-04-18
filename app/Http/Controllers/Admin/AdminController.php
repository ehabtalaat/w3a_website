<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\LawCategory\LawCategory;
use App\Models\LawService\LawService;
use App\Models\Doctor\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Role;

class AdminController extends Controller
{
    protected $view = 'admin_dashboard.admins.';
    protected $route = 'admins.';

    public function __construct()
    {
        $this->middleware(['permission:admins-create'])->only('create');
        $this->middleware(['permission:admins-read'])->only('index');
        $this->middleware(['permission:admins-update'])->only('edit');
        $this->middleware(['permission:admins-delete'])->only('destroy');
    }

    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    
    public function create()
    {

        $roles = Role::get();
        return view($this->view . 'create',compact('roles'));
    
    }

    
    public function store(StoreRequest $request)
    {
       
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['password'] = Hash::make($request->password);
  
  
        $admin = Doctor::create($data);

        if($request->role){
            $admin->attachRole($request->role); 
         }
        
       $data_image = [];

       //update image

       if ($request->hasFile('image')) {
           $data_image["image"] = upload_image($request->image, "admins");
       }


       //save image 
       $admin->image()->create($data_image);

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);
    }

    
    public function edit($id)
    {
        $admin = Doctor::whereId($id)->firstOrFail();
        $roles = Role::get();

        return view($this->view . 'edit', compact("admin","roles"));
    }

    
    public function update(UpdateRequest $request, $id)
    {
       
        $admin = Doctor::whereId($id)->firstOrFail();

        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['password'] = $request->password ? Hash::make($request->password) : $admin->password;
  
        $admin->update($data);


        if($request->role){
            $admin->syncRoles([$request->role]); 
         }

        $data_image = [];

        //update image

        if ($request->hasFile('image')) {
            $admin->image ? delete_image($admin->image->image) : null;
            $data_image["image"] = upload_image($request->image, "admins");
        }


        //save image 
        $admin->image()->updateOrCreate([
            "imageable_id" => $admin->id
        ],$data_image);
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $admin = Doctor::whereId($id)->firstOrFail();

        $admin->image ? delete_image($admin->image->image) : null;

        $admin->delete();
        return response()->json(['status' => true]);
    }
  

}
