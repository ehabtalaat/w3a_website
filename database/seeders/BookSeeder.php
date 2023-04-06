<?php

namespace Database\Seeders;

use App\Models\BookType\Book;
use App\Models\BookType\BookType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class BookSeeder extends Seeder
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

            'mini_text' => $faker->text(20),
            'text' => $faker->text(100)
          ];
        }
      
        $array = collect(BookType::get()->modelkeys());
        $data["pdf"] = 'uploads/default.pdf';
        

        $data["price"] =rand(10,223);
        $data["number_of_pages"] =rand(10,223);
        $data["type"] = rand(1,3);
        $data["book_type_id"] =  $array->random();

       $book = Book::create($data);


        //update image
 
       
       $data_image["image"] = 'uploads/default.png';

 
 
        //save image  
        $book->image()->create($data_image);
    }
    
    }
}
