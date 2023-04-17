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
        Schema::create('website_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('website_text_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_text_id')->unsigned();
            $table->longText('features_text')->nullable();
            $table->longText('courses_text')->nullable();
            $table->longText('store_text')->nullable();
            $table->longText('doctors_text')->nullable();
            $table->longText('blog_text')->nullable();
            $table->longText('brief_text')->nullable();
            $table->longText('website_reasons_text')->nullable();
            $table->longText('experiences_text')->nullable();
            $table->string('locale')->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('website_text_id')->references('id')->on('website_texts')
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
        Schema::dropIfExists('website_texts');
    }
};
