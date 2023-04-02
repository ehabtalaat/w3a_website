<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class AuthController extends Controller
{
    public function login()
    {
        return view("admin_dashboard.auth.login");
    }
    public function admin_login(Request $request)
    {
        $rules["phone"] = ["required"];
        $rules["password"] = ["required"];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return response()->json(["status" => false, "message" => $message]);
        }
        if (auth()->guard('admin')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {

            $message = __("messages.login successfully");
            return response()->json(["status" => true, "message" => $message]);
        }
        $message = __("messages.phone or password may be wrong");
        return response()->json(["status" => false, "message" => $message]);
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin_loginpage')->with(['success'=> __("messages.logout successfully")]);
    }
}
