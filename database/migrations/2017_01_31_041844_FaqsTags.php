<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FaqsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faq_id')->index();
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
            $table->unsignedInteger('tag_id')->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->unique(['faq_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_tag');
    }
}
