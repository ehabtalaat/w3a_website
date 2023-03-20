<?php

use App\Http\Controllers\Admin\MainHeaderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





// Route::group(
//      [
//          'prefix' => LaravelLocalization::setLocale(),
//          'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
//      ],
//      function () {
 //main_headers
 Route::group(['controller' => MainHeaderController::class], function () {
    Route::get("main_headers", "index")->name("main_headers.index");

    Route::put("main_headers/update", "update")->name("main_headers.update");
});

//  });
