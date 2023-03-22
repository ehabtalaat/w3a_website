<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MainHeaderController;
use App\Http\Controllers\Admin\TagController;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




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


        //blogs 
        Route::resource("blogs",BlogController::class);

        //features 
        Route::resource("features",FeatureController::class);

        //tags 
        Route::resource("tags",TagController::class);

//   });
