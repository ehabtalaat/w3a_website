<?php

namespace Database\Seeders;

use App\Models\CenterConsulting\CenterConsulting;
use App\Models\CenterConsulting\CenterConsultingFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class CenterConsultingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Factory::create();
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = ['title' =>  $faker->text(20),
                                 'text' => $faker->text(200),
          ];
        }
      
     $center_consulting = CenterConsulting:: create($data);

        $data_image = [];

       
            $data_image["image"] = 'uploads/default.png';
       


        //save image 
        $center_consulting->image()->updateOrCreate([
            "imageable_id" => $center_consulting->id
        ],$data_image);

       


       
        for($i = 0;$i < 2;$i++) {
         foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
             $data_title[$localeCode] = ['title' => $faker->text(20),
             'text' =>  $faker->text(100),
         ];
            }
            $data_title['center_consulting_id'] = $center_consulting->id;
           $center_consulting_feature =  CenterConsultingFeature::create($data_title);

            $feature_image = [];

        
                $feature_image["image"] = 'uploads/default.png';
          
    
    
            //save image 
            $center_consulting_feature->image()->updateOrCreate([
                "imageable_id" => $center_consulting_feature->id
            ],$feature_image);
         }
    }
} 
