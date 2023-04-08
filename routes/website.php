<?php

use App\Http\Controllers\Api\Website\AboutDoctorController;
use App\Http\Controllers\Api\Website\Auth\CheckCodeController;
use App\Http\Controllers\Api\Website\Auth\EmailController;
use App\Http\Controllers\Api\Website\Auth\LoginController;
use App\Http\Controllers\Api\Website\Auth\LogoutController;
use App\Http\Controllers\Api\Website\Auth\PasswordController as AuthPasswordController;
use App\Http\Controllers\Api\Website\Auth\RegisterController;
use App\Http\Controllers\Api\Website\BlogController;
use App\Http\Controllers\Api\Website\BookController;
use App\Http\Controllers\Api\Website\CenterConsultingController;
use App\Http\Controllers\Api\Website\CourseController;
use App\Http\Controllers\Api\Website\DoctorController;
use App\Http\Controllers\Api\Website\FeatureController;
use App\Http\Controllers\Api\Website\MainHeaderController;
use App\Http\Controllers\Api\Website\podcastController;
use App\Http\Controllers\Api\Website\Profile\PasswordController;
use App\Http\Controllers\Api\Website\Profile\ProfileController;
use App\Http\Controllers\Api\Website\SpecialAdviceController;
use App\Http\Controllers\Api\Website\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get("token_invalid",[RegisterController::class,"token_invalid"])->name("token_invalid");


//home
Route::get("fetch_main_header", [MainHeaderController::class, "index"]);

Route::get("fetch_about_doctor", [AboutDoctorController::class, "index"]);

Route::get("fetch_features", [FeatureController::class, "index"]);

Route::get("fetch_home_courses", [CourseController::class, "index"]);

Route::get("fetch_home_podcasts", [podcastController::class, "fetch_home_podcasts"]);

Route::get("fetch_special_advice", [SpecialAdviceController::class, "index"]);

Route::get("fetch_home_books", [BookController::class, "fetch_home_books"]);


Route::get("fetch_center_consulting", [CenterConsultingController::class, "index"]);



Route::get("fetch_home_blogs", [BlogController::class, "fetch_home_blogs"]);

Route::get("fetch_home_doctors", [DoctorController::class, "fetch_home_doctors"]);


//store


Route::group(['controller' => StoreController::class], function () {
    Route::get("fetch_store_header", "fetch_store_header");

    Route::get("fetch_website_reasons", "fetch_website_reasons");

    Route::get("fetch_website_expeienses", "fetch_website_expeienses");

    });

    //The educational platform

  
    Route::group(['controller' => CourseController::class], function () {
        Route::get("fetch_educational_platform", "fetch_educational_platform");
    
        Route::post("fetch_educational_platform_details", "fetch_educational_platform_details");
    
    
        });


  //podcasts

  
  Route::group(['controller' => podcastController::class], function () {
    Route::get("fetch_podcasts", "fetch_podcasts");

    Route::post("fetch_podcast_details", "fetch_podcast_details");


    });      


    //books

    Route::group(['controller' => BookController::class], function () {
        Route::get("fetch_categories", "fetch_categories");
    
        Route::post("fetch_books_by_category_id", "fetch_books_by_category_id");

        Route::post("fetch_book_details", "fetch_book_details");
    
    
        });    


//auth 
Route::post("login", [LoginController::class, "login"]);

Route::post("register", [RegisterController::class, "register"]);

Route::post("check_code", [CheckCodeController::class, "check_code"]);

Route::post("check_email", [EmailController::class, "check_email"]);

Route::post("reset_password", [AuthPasswordController::class, "reset_password"]);


Route::group(["middleware" => "auth:api"], function () {

    Route::get("logout", [LogoutController::class, "logout"]);

    //profile

Route::post("update_profile", [ProfileController::class, "update_profile"]);

Route::get("fetch_profile", [ProfileController::class, "fetch_profile"]);

Route::post("change_password", [PasswordController::class, "change_password"]);


});

