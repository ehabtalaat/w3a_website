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
        Schema::create('center_consultings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        
        Schema::create('center_consulting_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->string('locale')->nullable();
            $table->integer('center_consulting_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('center_consulting_id')->references('id')->on('center_consultings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });


        Schema::create('center_consulting_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_consulting_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->foreign('center_consulting_id')->references('id')->on('center_consultings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        
        Schema::create('center_consulting_feature_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->string('locale')->nullable();
            $table->integer('center_consulting_feature_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('center_consulting_feature_id','center_consulting_feature_idfk')->references('id')->on('center_consulting_features')
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
        Schema::dropIfExists('center_consultings');
    }
};
