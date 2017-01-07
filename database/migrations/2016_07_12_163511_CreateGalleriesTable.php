<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->string('alias_ru')->nullable();
            $table->string('alias_en')->nullable();
            $table->string('alias_customer')->nullable();
            $table->smallInteger('alias_priority')->nullable();
            $table->integer('position')->nullable();
            $table->integer('structure_id')->nullable();
            Nestedset\NestedSet::columns($table);
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
        Schema::drop('galleries');
    }
}
