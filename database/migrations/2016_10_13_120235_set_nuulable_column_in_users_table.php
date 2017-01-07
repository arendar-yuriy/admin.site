<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNuulableColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Config::get('database.default')=='pgsql'){
            DB::statement('ALTER TABLE users ALTER COLUMN password DROP NOT NULL;');
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Config::get('database.default')=='pgsql') DB::statement('ALTER TABLE users ALTER COLUMN password SET NOT NULL;');
    }
}
