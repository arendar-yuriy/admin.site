<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->string('alias')->nullable();
            $table->string('alias_ru')->nullable();
            $table->string('alias_en')->nullable();
            $table->string('alias_customer')->nullable();
            $table->smallInteger('alias_priority')->nullable();
            $table->string('type',32)->nullable();
            $table->integer('position')->nullable();
            $table->string('level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contents');
    }
}
