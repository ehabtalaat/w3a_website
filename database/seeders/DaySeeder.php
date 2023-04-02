<?php

namespace Database\Seeders;

use App\Models\Day\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data1["ar"] = ['title' => "الاحد"];
        $data1["en"] = ['title' => "Sunday"];
        $data1["day_of_week"] = 0;
        Day::create($data1);

        $data2["ar"] = ['title' => "الاثنين"];
        $data2["en"] = ['title' => "Monday"];
        $data2["day_of_week"] = 1;
        Day::create($data2);


        $data3["ar"] = ['title' => "الثلاثاء"];
        $data3["en"] = ['title' => "Tuesday"];
        $data3["day_of_week"] = 2;
        Day::create($data3);



        $data4["ar"] = ['title' => "الاربعاء"];
        $data4["en"] = ['title' => "Wednesday"];
        $data4["day_of_week"] = 3;
        Day::create($data4);


        $data5["ar"] = ['title' => "الخميس"];
        $data5["en"] = ['title' => "Thursday"];
        $data5["day_of_week"] = 4;
        Day::create($data5);


        $data6["ar"] = ['title' => "الجمعه"];
        $data6["en"] = ['title' => "Friday"];
        $data6["day_of_week"] = 5;
        Day::create($data6);


        $data7["ar"] = ['title' => "السبت"];
        $data7["en"] = ['title' => "Saturday"];
        $data7["day_of_week"] = 6;
        Day::create($data7);
    }
}
