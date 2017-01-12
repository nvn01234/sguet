<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Scaffoldinterfaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scaffoldinterfaces', function (Blueprint $table) {
            $table->increments('id');
            $table->String('package')->default('Laravel');
            $table->String('migration');
            $table->String('model');
            $table->String('controller');
            $table->String('views');
            $table->String('tablename');
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
        Schema::drop('scaffoldinterfaces');
    }
}
