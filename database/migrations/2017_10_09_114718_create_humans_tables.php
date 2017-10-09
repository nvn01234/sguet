<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHumansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('humans', function(Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('academic_title')->nullable();
        });
        Schema::create('humans_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('human_id');
            $table->unsignedInteger('department_id');
            $table->foreign('human_id')->references('id')->on('humans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('position')->nullable();
        });
        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        Schema::dropIfExists('humans_departments');
        Schema::dropIfExists('humans');
        DB::commit();
    }
}
