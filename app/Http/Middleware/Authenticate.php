<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->is("api/*")){
            return route('token_invalid'); 
        } 
        if (! $request->expectsJson()) {
            if ($request->is('*/admin/*') || $request->is('/admin') || $request->is('*/admin')) {
            return route('admin_loginpage');
        }else  if ($request->is('*/pharmacy/*') || $request->is('/pharmacy') || $request->is('*/pharmacy')) {
            return route('pharmacy_login');
        }
    }
}
}
