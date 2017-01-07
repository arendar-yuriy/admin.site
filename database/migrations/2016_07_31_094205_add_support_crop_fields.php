<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupportCropFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_translations', function (Blueprint $table) {
            $table->boolean('is_crop')->default(false);
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
        });

        Schema::table('admin_users', function (Blueprint $table) {
            $table->boolean('is_crop')->default(false);
            $table->string('image',1024)->nullable();
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
        });

        Schema::table('structure_translations', function (Blueprint $table) {
            $table->boolean('is_crop')->default(false);
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
        });

        Schema::table('gallery_translations', function (Blueprint $table) {
            $table->boolean('is_crop')->default(false);
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
        });

        Schema::table('gallery_units', function (Blueprint $table) {
            $table->boolean('is_crop')->default(false);
            $table->string('data_crop',1024)->nullable();
            $table->string('data_crop_info',1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_translations',function($table){
            $table->dropColumn('is_crop');
            $table->dropColumn('data_crop');
            $table->dropColumn('data_crop_info');
        });

        Schema::table('admin_users',function($table){
            $table->dropColumn('is_crop');
            $table->dropColumn('image');
            $table->dropColumn('data_crop');
            $table->dropColumn('data_crop_info');
        });

        Schema::table('structure_translations',function($table){
            $table->dropColumn('is_crop');
            $table->dropColumn('data_crop');
            $table->dropColumn('data_crop_info');
        });

        Schema::table('gallery_translations',function($table){
            $table->dropColumn('is_crop');
            $table->dropColumn('data_crop');
            $table->dropColumn('data_crop_info');
        });

        Schema::table('gallery_units',function($table){
            $table->dropColumn('is_crop');
            $table->dropColumn('data_crop');
            $table->dropColumn('data_crop_info');
        });
    }
}
