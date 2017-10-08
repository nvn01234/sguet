<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->unsignedInteger('credits');
            $table->unsignedInteger('theory_credit_hours');
            $table->unsignedInteger('practice_credit_hours');
            $table->unsignedInteger('self_study_credit_hours');
            $table->string('pre_subject_code')->nullable();
            $table->text('abstract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
