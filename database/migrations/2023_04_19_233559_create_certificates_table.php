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
            Schema::create('certificates', function (Blueprint $table) {
                $table->increments("id");
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            });
            
            Schema::create('certificate_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->longText('text')->nullable();
                $table->string('locale')->nullable();
                $table->integer('certificate_id')->unsigned()->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
    
                $table->foreign('certificate_id')->references('id')->on('certificates')
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
        Schema::dropIfExists('certificates');
    }
};
