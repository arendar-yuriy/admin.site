<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function ($table) {
            $table->softDeletes();
        });
        Schema::table('comments', function ($table) {
            $table->softDeletes();
        });
        Schema::table('constants', function ($table) {
            $table->softDeletes();
        });
        Schema::table('contents', function ($table) {
            $table->softDeletes();
        });
        Schema::table('feedback', function ($table) {
            $table->softDeletes();
        });
        Schema::table('galleries', function ($table) {
            $table->softDeletes();
        });
        Schema::table('gallery_units', function ($table) {
            $table->softDeletes();
        });
        Schema::table('permissions', function ($table) {
            $table->softDeletes();
        });
        Schema::table('roles', function ($table) {
            $table->softDeletes();
        });
        Schema::table('structures', function ($table) {
            $table->softDeletes();
        });
        Schema::table('tags', function ($table) {
            $table->softDeletes();
        });
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });
        Schema::table('users_social', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('comments', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('constants', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('contents', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('feedback', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('galleries', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('gallery_units', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('permissions', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('roles', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('structures', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('tags', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('users', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('users_social', function ($table) {
            $table->dropColumn('deleted_at');
        });
    }
}
