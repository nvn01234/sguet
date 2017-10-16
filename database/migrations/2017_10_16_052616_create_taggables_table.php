<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::create('taggable_tag', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('taggable_id')->index();
            $table->unsignedInteger('tag_id')->index();
            $table->foreign('taggable_id')->references('id')->on('taggables')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedInteger('taggable_id')->index()->nullable();
            $table->foreign('taggable_id')->references('id')->on('taggables')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->unsignedInteger('taggable_id')->index()->nullable();
            $table->foreign('taggable_id')->references('id')->on('taggables')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('taggable_tag');
    }
}
