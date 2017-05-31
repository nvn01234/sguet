<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntrustRoleLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function(Blueprint $table) {
            $table->smallInteger('level')->default(0);
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->text('short_description')->change();
        });

        Schema::table('search_logs', function (Blueprint $table) {
            $table->text('text')->change();
        });

        Schema::table('faqs', function(Blueprint $table) {
            $table->text('question')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
