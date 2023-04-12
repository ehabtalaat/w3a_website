<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BookType\BookType;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DaySeeder::class,
            AdminSeeder::class,
            TagSeeder::class,
            BookTypeSeeder::class,
            ConsultationSeeder::class,
            PaymentMethodSeeder::class,
            MainHeaderSeeder::class,
            AboutDoctorSeeder::class,
            FeatureSeeder::class,
            CourseSeeder::class,
            AboutPodcastSeeder::class,
            PodcastSeeder::class,
            SpecialAdviceSeeder::class,
            BookSeeder::class,
            CenterConsultingSeeder::class,
            BlogSeeder::class,
            DoctorSeeder::class,
            StoreHeaderSeeder::class,
            WebsiteReasonSeeder::class,
            ExperienceSeeder::class,
            AboutHeaderSeeder::class,
            LaratrustSeeder::class
          
            

           
        ]);
    }
}
