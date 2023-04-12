<?php

namespace Database\Seeders;

use App\Models\Consultation\Consultation;
use App\Models\Day\Day;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorDay;
use App\Models\Doctor\DoctorDayTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0;$i < 6;$i++){
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['mini_description' => $faker->text(30),
                                 'description' => $faker->text(100)
          ];
        }
        $data['phone'] =  $faker->phoneNumber;
        $data['email'] = $faker->email;
        $data['name'] = $faker->name;
        $data['type'] = 2;
        $data['password'] = Hash::make(123123123);
  
  
        $doctor = Doctor::create($data);

        
       $data_image = [];

       //update image

    
           $data_image["image"] = 'uploads/default.png';
 


       //save image 
       $doctor->image()->create($data_image);


       $consultation_ids = Consultation::get()->modelKeys();
      

      
        for ($e = 0; $e < count($consultation_ids); $e++) {
            $sync_data[$consultation_ids[$i]] = ['time' => rand(20,50),
            'price' => rand(20,50)];
        }
    
        $doctor->consultations()->attach($sync_data);

        $day_ids = collect(Day::all()->modelKeys());
        foreach($day_ids as $day_id){

            $day_data["day_id"] = $day_id;
            $day_data["doctor_id"] = $doctor->id;
           
            $day_data["active"] = 1;
            DoctorDay::create($day_data);

            $doctor_day_ids = collect(DoctorDay::all()->modelKeys());
            foreach($doctor_day_ids as $doctor_day_id){
            

            $time_data["day_id"] = 1;
            $time_data["doctor_day_id"] = $doctor_day_id;
            $time_data["from_time"] = $faker->time( 'H:i:s', '15:00:00' );
            $time_data["to_time"] =  $faker->time( 'H:i:s', '20:00:00' );
            DoctorDayTime::create($time_data);
            
            }
        }   
    }
}

}