<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullTextSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Config::get('database.default')=='pgsql') {
            DB::statement('ALTER TABLE content_translations ADD searchable tsvector NULL');
            DB::statement('CREATE INDEX content_translations_searchable_index ON content_translations USING GIN (searchable)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Config::get('database.default')=='pgsql') {
            Schema::table('content_translations',function (Blueprint $table){
                $table->dropColumn('searchable');
            });
        }
    }
}
