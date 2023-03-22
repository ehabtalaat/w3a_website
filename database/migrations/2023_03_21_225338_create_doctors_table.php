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

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('doctor_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mini_about')->nullable();
            $table->longText('about')->nullable();
            $table->string('locale')->nullable();
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('doctor_id')->references('id')->on('doctors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('podcast_consultations', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('podcast_id')->unsigned()->nullable();
            $table->integer('consultation_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('podcast_id')->references('id')->on('podcasts')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('consultation_id')->references('id')->on('consultations')
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
