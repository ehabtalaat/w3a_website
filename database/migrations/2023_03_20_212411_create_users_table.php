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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->nullable();
            $table->text('password')->nullable();
            $table->text('chronic_diseases')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('gender')->unsigned()->default(1)->comment("1 => male,2 => female");
            $table->tinyInteger('is_verified')->unsigned()->default(0);
            $table->integer('age')->unsigned()->nullable();
            $table->text('api_token')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('user_courses', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('course_id')->references('id')->on('courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });


        
        Schema::create('user_books', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('book_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('book_id')->references('id')->on('books')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        
        Schema::create('user_podcasts', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('podcast_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('podcast_id')->references('id')->on('podcasts')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        Schema::create('book_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->double('rate')->nullable();
            $table->longText('comment')->nullable();
            $table->integer('book_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('book_id')->references('id')->on('books')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('users');
    }
};
