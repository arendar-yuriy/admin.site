<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_units', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->integer('gallery_id')->unsigned();
            $table->string('image',1024);
            $table->integer('position');
            $table->boolean('cover')->default(false);
            $table->timestamps();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('gallery_units');
       // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
       // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
