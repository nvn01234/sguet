<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Tags.
 *
 * @author  The scaffold-interface created at 2017-01-11 05:19:59pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');

            $table->String('name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
