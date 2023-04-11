<?php

namespace Database\Seeders;

use App\Models\Consultation\Consultation;
use App\Models\Doctor\Doctor;
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
    }
}

}