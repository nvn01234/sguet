<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSearchLog2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('search_results');
        Schema::dropIfExists('search_logs');
        Schema::create('search_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('text');
            $table->string('ip');
            $table->unsignedInteger('faqs_count');
            $table->unsignedInteger('contacts_count');
            $table->timestamps();
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
        //
    }
}
