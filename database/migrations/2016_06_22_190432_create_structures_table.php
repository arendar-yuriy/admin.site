<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('published')->default(true);
            $table->string('alias_ru')->nullable();
            $table->string('alias_en')->nullable();
            $table->string('alias_customer')->nullable();
            $table->smallInteger('alias_priority')->nullable();
            $table->string('template',32)->nullable();
            $table->string('type',32)->nullable();
            $table->integer('position')->nullable();
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
        Schema::drop('structures');
    }
}
