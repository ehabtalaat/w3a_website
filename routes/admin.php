<?php

use App\Http\Controllers\Admin\AboutDoctorController;
use App\Http\Controllers\Admin\AboutHeaderController;
use App\Http\Controllers\Admin\AboutPodcastController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookTypeController;
use App\Http\Controllers\Admin\CenterConsultingController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\Doctor\ConsultationController as DoctorConsultationController;
use App\Http\Controllers\Admin\Doctor\DoctorController;
use App\Http\Controllers\Admin\Doctor\OffLineTimeController;
use App\Http\Controllers\Admin\Doctor\TimeController;
use App\Http\Controllers\Admin\Doctor\DoctorExperienceController;
use App\Http\Controllers\Admin\Doctor\DoctorCertificateController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\MainHeaderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PodcastController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecialAdviceController;
use App\Http\Controllers\Admin\StoreHeaderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteReasonController;
use App\Http\Controllers\Admin\WebsiteTextController;
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

      Route::group(["middleware" => "guest:admin"], function () {
                
         Route::get("login", [AuthController::class, "login"])->name("admin_loginpage");
         Route::post("admin_login", [AuthController::class, "admin_login"])->name("admin_login");
     });
      Route::group(["middleware" => "auth:admin"], function () {
         Route::get("logout", [AuthController::class, "logout"])->name("logout");
        //main_headers
      //   Route::group(['controller' => MainHeaderController::class], function () {
      //   Route::get("main_headers", "index")->name("main_headers.index");

      //   Route::put("main_headers/update", "update")->name("main_headers.update");
      //   });

        Route::resource("main_headers",MainHeaderController::class);


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
        
         //certificates
         Route::group(['controller' => CertificateController::class], function () {
            Route::get("certificates", "index")->name("certificates.index");
    
            Route::put("certificates/update", "update")->name("certificates.update");
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

   
      //admins 
      Route::resource("admins",AdminController::class);      

      //doctors 
      Route::resource("doctors",DoctorController::class);      

     Route::group(['controller' => DoctorController::class], function () {
      Route::post("doctors/active", "active")->name("doctors.active");
      Route::post("doctors/main", "main")->name("doctors.main");
      });
 


        //doctor_experiences
        Route::group(['controller' => DoctorExperienceController::class], function () {
         Route::get("doctor_experiences/{id}", "index")->name("doctor_experiences.index");

         Route::get("doctor_experiences/create/{id}", "create")->name("doctor_experiences.create");

         Route::post("doctor_experiences/store/{id}", "store")->name("doctor_experiences.store");

         Route::get("doctor_experiences/edit/{id}", "edit")->name("doctor_experiences.edit");

         Route::put("doctor_experiences/update/{id}", "update")->name("doctor_experiences.update");

         Route::delete("doctor_experiences/{id}", "destroy")->name("doctor_experiences.destroy");

     });

     //doctor_certificates

     Route::group(['controller' => DoctorCertificateController::class], function () {
      Route::get("doctor_certificates/{id}", "index")->name("doctor_certificates.index");

      Route::get("doctor_certificates/create/{id}", "create")->name("doctor_certificates.create");

      Route::post("doctor_certificates/store/{id}", "store")->name("doctor_certificates.store");

      Route::get("doctor_certificates/edit/{id}", "edit")->name("doctor_certificates.edit");

      Route::put("doctor_certificates/update/{id}", "update")->name("doctor_certificates.update");

      Route::delete("doctor_certificates/{id}", "destroy")->name("doctor_certificates.destroy");

  });
      //doctor_times
      Route::group(['controller' => TimeController::class], function () {
      Route::get("doctor_times/{id}", "index")->name("doctor_times.index");

      Route::post("doctor_times/update/{id}", "update")->name("doctor_times.update");
      });

      Route::group(['controller' => OffLineTimeController::class], function () {
         Route::get("doctor_offline_times/{id}", "index")->name("doctor_offline_times.index");
   
         Route::post("doctor_offline_times/update/{id}", "update")->name("doctor_offline_times.update");
         });

        //doctor_consultations
        Route::group(['controller' => DoctorConsultationController::class], function () {
         Route::get("doctor_consultations/{id}", "index")->name("doctor_consultations.index");
   
         Route::post("doctor_consultations/update/{id}", "update")->name("doctor_consultations.update");
         });
   
               
    //center_consultings
     Route::group(['controller' => CenterConsultingController::class], function () {
      Route::get("center_consultings", "index")->name("center_consultings.index");

      Route::put("center_consultings/update", "update")->name("center_consultings.update");
      });

         //courses 
         Route::resource("courses",CourseController::class); 

 
         
            //lessons
            Route::group(['controller' => LessonController::class], function () {
               Route::get("lessons/{id}", "index")->name("lessons.index");

               Route::get("lessons/create/{id}", "create")->name("lessons.create");

               Route::post("lessons/store/{id}", "store")->name("lessons.store");

               Route::get("lessons/edit/{id}", "edit")->name("lessons.edit");

               Route::put("lessons/update/{id}", "update")->name("lessons.update");

               Route::delete("lessons/{id}", "destroy")->name("lessons.destroy");

           });

            //podcasts 
         Route::resource("podcasts",PodcastController::class); 


         
            //books 
            Route::resource("books",BookController::class); 


         
        //reservations
        Route::group(['controller' => ReservationController::class], function () {
         Route::get("reservations", "index")->name("reservations.index");
         Route::post("reservations/change_status", "change_status")->name("reservations.change_status");
         Route::get("reservations/{id}", "show")->name("reservations.show");
         Route::get("reservation_result/{id}", "result")->name("reservations.result");
         Route::post("reservations_save_result/{id}", "save_result")->name("reservations.save_result");
 
         });    

         Route::resource("roles",RoleController::class); 

         
         //settings
         Route::get('settings', [SettingController::class ,'index'])->name('settings.index');
         Route::post('settings/update', [SettingController::class ,'update'])->name('settings.update');


          //website_texts
          Route::get('website_texts', [WebsiteTextController::class ,'index'])->name('website_texts.index');
          Route::post('website_texts/update', [WebsiteTextController::class ,'update'])->name('website_texts.update');

         });

         //users
         Route::group(['controller' => UserController::class], function () {
            Route::get("users", "index")->name("users.index");
            Route::post("users", "destroy")->name("users.destroy");
            });
  });
