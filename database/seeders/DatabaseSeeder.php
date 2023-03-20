<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Admin\Database\Seeders\CountrySeeder;
use Admin\Database\Seeders\AdminSeeder;
use Admin\Database\Seeders\PharmacySeeder;
use PharmacyDashboard\Database\Seeders\BannerSeeder;
use PharmacyDashboard\Database\Seeders\CategorySeeder;
use PharmacyDashboard\Database\Seeders\SubcategorySeeder;
use PharmacyDashboard\Database\Seeders\FeatureSeeder;
use PharmacyDashboard\Database\Seeders\PrivacySeeder;
use PharmacyDashboard\Database\Seeders\TermSeeder;
use PharmacyDashboard\Database\Seeders\BrandSeeder;
use PharmacyDashboard\Database\Seeders\ProductSeeder;
use PharmacyDashboard\Database\Seeders\SettingSeeder;
use PharmacyDashboard\Database\Seeders\BranchSeeder;
use PharmacyDashboard\Database\Seeders\OfferSeeder;
use Admin\Database\Seeders\PaymentMethodSeeder;
use PharmacyDashboard\Database\Seeders\ReturnReasonSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            
            AdminSeeder::class,
            PaymentMethodSeeder::class,
            CountrySeeder::class,
            PharmacySeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            FeatureSeeder::class,
            PrivacySeeder::class,
            BrandSeeder::class,
            TermSeeder::class,
            BranchSeeder::class,
            SettingSeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            BannerSeeder::class,
            ReturnReasonSeeder::class
        ]);
    }
}
