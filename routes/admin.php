<?php

use App\Http\Controllers\Admin\AboutDoctorController;
use App\Http\Controllers\Admin\AboutHeaderController;
use App\Http\Controllers\Admin\AboutPodcastController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookTypeController;
use App\Http\Controllers\Admin\CenterConsultingController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MainHeaderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SpecialAdviceController;
use App\Http\Controllers\Admin\StoreHeaderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\WebsiteReasonController;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
     [
         'prefix' => LaravelLocalization::setLocale(),
         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
     ],
     function () {


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

           //about_doctors
        Route::group(['controller' => AboutDoctorController::class], function () {
                Route::get("about_doctors", "index")->name("about_doctors.index");
        
                Route::put("about_doctors/update", "update")->name("about_doctors.update");
                });


           //about_podcasts
         Route::group(['controller' => AboutPodcastController::class], function () {
                Route::get("about_podcasts", "index")->name("about_podcasts.index");

                Route::put("about_podcasts/update", "update")->name("about_podcasts.update");
                });       


        //book_types 
        Route::resource("book_types",BookTypeController::class); 
        
        

        //about_headers
        Route::group(['controller' => AboutHeaderController::class], function () {
        Route::get("about_headers", "index")->name("about_headers.index");

        Route::put("about_headers/update", "update")->name("about_headers.update");
        }); 



     //special_advices
     Route::group(['controller' => SpecialAdviceController::class], function () {
        Route::get("special_advices", "index")->name("special_advices.index");

        Route::put("special_advices/update", "update")->name("special_advices.update");
        });
        
        
    //store_headers
     Route::group(['controller' => StoreHeaderController::class], function () {
      Route::get("store_headers", "index")->name("store_headers.index");

      Route::put("store_headers/update", "update")->name("store_headers.update");
      });

      //payment_methods 
      Route::resource("payment_methods",PaymentMethodController::class); 


      //website_reasons 
      Route::resource("website_reasons",WebsiteReasonController::class); 

      //experiences 
      Route::resource("experiences",ExperienceController::class); 

         //consultations 
         Route::resource("consultations",ConsultationController::class); 


               
    //center_consultings
     Route::group(['controller' => CenterConsultingController::class], function () {
      Route::get("center_consultings", "index")->name("center_consultings.index");

      Route::put("center_consultings/update", "update")->name("center_consultings.update");
      });
  });
