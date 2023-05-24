<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;

use App\Models\User\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UserController extends Controller
{
    protected $view = 'admin_dashboard.users.';
    protected $route = 'users.';


 

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }


    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        $user->image ? delete_image($user->image->image) : null;

        //delete
        $user->delete();
        return response()->json(['status' => true]);

    }
}
