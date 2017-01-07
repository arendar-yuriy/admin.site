<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatePublishedToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Config::get('database.default')=='pgsql'){
            DB::statement('ALTER TABLE contents ADD COLUMN date_published TIMESTAMP;');
            DB::statement('ALTER TABLE contents ALTER COLUMN date_published DROP NOT NULL;');
        }else{
            Schema::table('contents', function (Blueprint $table) {
                $table->timestamp('date_published')->nullabe()->after('updated_at');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        if(Config::get('database.default')=='pgsql') DB::statement('ALTER TABLE users ALTER COLUMN password SET NOT NULL;');
//        else
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('date_published');
        });
    }
}
