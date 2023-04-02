<?php

use App\Http\Controllers\Api\Website\AboutDoctorController;
use App\Http\Controllers\Api\Website\BlogController;
use App\Http\Controllers\Api\Website\BookController;
use App\Http\Controllers\Api\Website\CenterConsultingController;
use App\Http\Controllers\Api\Website\CourseController;
use App\Http\Controllers\Api\Website\DoctorController;
use App\Http\Controllers\Api\Website\FeatureController;
use App\Http\Controllers\Api\Website\MainHeaderController;
use App\Http\Controllers\Api\Website\podcastController;
use App\Http\Controllers\Api\Website\SpecialAdviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





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



