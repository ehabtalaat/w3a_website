<?php

use App\Http\Controllers\Api\Website\WebsiteTextController;
use App\Http\Controllers\Api\Website\AboutDoctorController;
use App\Http\Controllers\Api\Website\AboutHeaderController;
use App\Http\Controllers\Api\Website\Auth\CheckCodeController;
use App\Http\Controllers\Api\Website\Auth\EmailController;
use App\Http\Controllers\Api\Website\Auth\LoginController;
use App\Http\Controllers\Api\Website\Auth\LogoutController;
use App\Http\Controllers\Api\Website\Auth\PasswordController as AuthPasswordController;
use App\Http\Controllers\Api\Website\Auth\RegisterController;
use App\Http\Controllers\Api\Website\BlogController;
use App\Http\Controllers\Api\Website\BookController;
use App\Http\Controllers\Api\Website\CenterConsultingController;
use App\Http\Controllers\Api\Website\ConsultationController;
use App\Http\Controllers\Api\Website\CourseController;
use App\Http\Controllers\Api\Website\DoctorController;
use App\Http\Controllers\Api\Website\FeatureController;
use App\Http\Controllers\Api\Website\MainHeaderController;
use App\Http\Controllers\Api\Website\podcastController;
use App\Http\Controllers\Api\Website\Profile\PasswordController;
use App\Http\Controllers\Api\Website\Profile\ProfileController;
use App\Http\Controllers\Api\Website\ReservationController;
use App\Http\Controllers\Api\Website\SettingController;
use App\Http\Controllers\Api\Website\SpecialAdviceController;
use App\Http\Controllers\Api\Website\StoreController;
use App\Http\Controllers\Api\Website\TimeController;
use App\Http\Controllers\Api\Website\UserBookController;
use App\Http\Controllers\Api\Website\UserCourseController;
use App\Http\Controllers\Api\Website\UserPodcastController;
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
Route::get("fetch_main_doctor", [DoctorController::class, "fetch_main_doctor"]);


Route::get('fetch_setting', [SettingController::class, 'fetch_setting']);

Route::get('fetch_website_texts', [WebsiteTextController::class, 'fetch_website_texts']);

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

        Route::post("fetch_course_lessons", "fetch_course_lessons");
    
    
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
        
        Route::post("rate_book", "rate_book");
    
    
        });    


    //blogs

    Route::group(['controller' => BlogController::class], function () {
        Route::get("fetch_blogs", "fetch_blogs");
    
        Route::post("blog_details", "blog_details");
    
    
        });     
        
  
    //consultations
        
    Route::group(['controller' => ConsultationController::class], function () {

        Route::get("fetch_consultations", "index");
    
        Route::post("fetch_consultation_doctors", "fetch_consultation_doctors");
    
    
        });     

//fetch_about_header

Route::get("fetch_about_header", [AboutHeaderController::class, "index"]);

//times

Route::group(['controller' => TimeController::class], function () {

    Route::post("filter_doctor_times_by_date", "filter_doctor_times_by_date");


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

//buy book

Route::group(['controller' => UserBookController::class], function () {

    Route::post("buy_book", "buy");
    Route::get("your_books", "index");

    }); 

    Route::group(['controller' => UserCourseController::class], function () {

        Route::post("buy_course", "buy");
       Route::get("your_courses", "index");

    
        }); 

Route::group(['controller' => UserPodcastController::class], function () {

    Route::post("buy_podcast", "buy");
    Route::get("your_podcasts", "index");


    });    

    

    //reservations

Route::group(['controller' => ReservationController::class], function () {

    Route::post("make_reservation", "store");
    Route::get("fetch_your_reservations", "fetch_your_reservations");
    Route::post("reservation_details", "reservation_details");

    }); 
});

