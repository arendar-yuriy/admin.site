<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_gallery_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_unit_id')->unsigned()->index();
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('gallery_unit_id')->references('id')->on('gallery_units')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags_gallery_units');
    }
}
