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
