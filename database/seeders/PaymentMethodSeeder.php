<?php

namespace Database\Seeders;

use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class PaymentMethodSeeder extends Seeder
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
            $data[$localeCode] = ['title' => $faker->text(20),
            'text' => $faker->text(100)
          ];
        }
      
        
        
       $PaymentMethod = PaymentMethod::create($data);


        //update image
 
       
            $data_image["image"] = 'uploads/default.png';

 
 
        //save image 
        $PaymentMethod->image()->create($data_image);
    }
    
    }
}
