<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('new');
            $table->integer('content_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();;
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('site')->nullable();
            $table->text('comment');
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('url')->nullable();
            $table->string('locale')->nullable();
            $table->string('ip')->nullable();
            Nestedset\NestedSet::columns($table);
            $table->timestamps();
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
