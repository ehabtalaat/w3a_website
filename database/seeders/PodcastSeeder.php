<?php

namespace Database\Seeders;

use App\Models\Podcast\Podcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class PodcastSeeder extends Seeder
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
      
        $data["price"] = rand(4151,54415);

        $data["mintues"] = rand(4,54);

        $data["audio"] = 'uploads/default.mp4';

       $podcast = Podcast::create($data);


        //update image
 
       
       $data_image["image"] = 'uploads/default.png';

 
 
        //save image 
        $podcast->image()->create($data_image);
    }
}
}
