<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SearchResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_results', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('search_log_id')->index();
            $table->foreign('search_log_id')->references('id')->on('search_logs')->onDelete('cascade');
            $table->unsignedInteger('faq_id')->index();
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_results');
    }
}
