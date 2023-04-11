<?php

namespace Database\Seeders;

use App\Models\AboutHeader\AboutHeader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class AboutHeaderSeeder extends Seeder
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
            $data[$localeCode] = ['title' => $faker->text(20),
            'text' => $faker->text(100)
          ];
        }
      
        
        
       $main_header = AboutHeader::create($data);


        //update image
 
       
            $data_image["image"] = 'uploads/default.png';

 
 
        //save image 
        $main_header->image()->create($data_image);
    
    }
}
