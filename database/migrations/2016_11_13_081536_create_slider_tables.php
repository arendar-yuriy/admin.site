<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->string('alias')->unsigned();
            $table->integer('structure_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sliders_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sliders_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreign('sliders_id')->references('id')->on('sliders')->onDelete('cascade');
        });

        Schema::create('slider_units', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->integer('position')->nullable();
            $table->integer('slider_id')->unsigned();
            $table->string('image',1024);
            $table->boolean('is_crop')->default(false);
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('slider_units_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slider_units_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreign('slider_units_id')->references('id')->on('slider_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider_units_translations');
        Schema::drop('slider_units');
        Schema::drop('sliders_translations');
        Schema::drop('sliders');
    }
}
