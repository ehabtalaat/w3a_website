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
        Schema::create('book_types', function (Blueprint $table) {
            $table->increments("id");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        
        Schema::create('book_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('locale')->nullable();
            $table->integer('book_type_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('book_type_id')->references('id')->on('book_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('book_type_id')->unsigned()->nullable();
            $table->integer('number_of_pages')->unsigned()->nullable();
            $table->tinyInteger('type')->unsigned()->default(1)->comment("1 => pdf,2 => paper, 3 =>pdf and paper");
            $table->string('pdf')->nullable();
            $table->double('price')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('book_type_id')->references('id')->on('book_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        
        Schema::create('book_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('mini_text')->nullable();
            $table->longText('text')->nullable();
            $table->string('locale')->nullable();
            $table->integer('book_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('book_id')->references('id')->on('books')
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
        Schema::dropIfExists('book_types');
    }
};
