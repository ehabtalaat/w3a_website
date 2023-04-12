<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RoleController extends Controller
{
    protected $view = 'admin_dashboard.roles.';
    protected $route = 'roles.';

    // public function __construct()
    // {
    //     $this->middleware(['permission:roles-create'])->only('create');
    //     $this->middleware(['permission:roles-read'])->only('index');
    //     $this->middleware(['permission:roles-update'])->only('edit');
    //     $this->middleware(['permission:roles-delete'])->only('destroy');
    // }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');

    } 

    
    public function create()
    {
        return view($this->view . 'create' );
    }

    
    public function store(StoreRequest $request)
    {

          $data['name'] = $request->name;
      
       $role =  Role::create($data);

        if($request->permissions) {
            $role->attachPermissions($request->permissions);
        }

        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.createmessage")]);
    }

    
    public function edit($id)
    {
        $role = Role::whereId($id)->first();
        return view($this->view . 'edit' , compact('role'));
    }

    
    public function update(UpdateRequest $request, $id)
    {
        $role = Role::whereId($id)->first();
        $data['name'] = $request->name;


        $role->update($data);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route($this->route."index")
        ->with(['success'=> __("messages.editmessage")]);
    }

    
    public function destroy($id)
    {
        $role = Role::whereId($id)->first();
        $role->delete();
        return response()->json(['status' => true]);
    }
}
