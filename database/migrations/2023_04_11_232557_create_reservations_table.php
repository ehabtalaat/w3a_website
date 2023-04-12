<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consultation_id')->unsigned()->nullable();


            $table->string("user_name")->nullable();
            $table->string("user_phone")->nullable();
            $table->tinyInteger('for_another_person')->unsigned()->default(0); // 0 or 1
            $table->string("another_person_name")->nullable();
            $table->string("another_person_phone")->nullable();
            $table->tinyInteger('contact_type')->unsigned()->nullable(); // 1 or 2
            $table->date("date")->nullable();

            $table->integer('price')->unsigned()->nullable();
            $table->integer('time')->unsigned()->nullable();

            $table->integer('doctor_day_time_id')->unsigned()->nullable();
            $table->tinyInteger('status')->unsigned()->default(0); 


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('lawyers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
