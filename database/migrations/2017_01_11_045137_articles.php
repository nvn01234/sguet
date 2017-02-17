<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Articles.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:51:37pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');

            $table->String('title');

            $table->String('short_description');

            $table->longText('body');

            $table->String('image_url')->nullable();

            $table->unsignedInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();


            // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
