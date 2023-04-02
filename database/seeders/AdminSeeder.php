<?php

namespace Database\Seeders;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data["name"] = "admin";
        $data["phone"] = "01009060299";

        $data["password"] = hash_user_password(123123123);
        $admin = Doctor::create($data);


    }
}
