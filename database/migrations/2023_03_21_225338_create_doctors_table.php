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
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('password')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->tinyInteger('main')->unsigned()->default(0);
            $table->tinyInteger('type')->unsigned()->default(1)->comment("1 => admin, 2 => doctor");
            $table->integer('waiting_time')->unsigned()->default(30);
            $table->text('remember_token')->nullable();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('doctor_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mini_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('locale')->nullable();
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('doctor_consultations', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->integer('consultation_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->double('time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('consultation_id')->references('id')->on('consultations')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('doctor_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->integer('day_id')->unsigned()->nullable();
            $table->tinyInteger('offline')->unsigned()->default(0);
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('day_id')->references('id')->on('days')
            ->onUpdate('cascade')
            ->onDelete('cascade');

       
        });

        Schema::create('doctor_day_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id')->unsigned()->nullable();
            $table->integer('doctor_day_id')->unsigned()->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('day_id')->references('id')->on('days')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('doctor_day_id')->references('id')->on('doctor_days')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

        Schema::create('doctor_experiences', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });
        
        Schema::create('doctor_experience_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->string('locale')->nullable();
            $table->integer('doctor_experience_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_experience_id')->references('id')->on('doctor_experiences')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('doctor_certificates', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        
        Schema::create('doctor_certificate_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->string('locale')->nullable();
            $table->integer('doctor_certificate_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_certificate_id')->references('id')->on('doctor_certificates')
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
        Schema::dropIfExists('doctors');
    }
};
