<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Categories.
 *
 * @author  The scaffold-interface created at 2017-01-12 04:59:17pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

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
        Schema::dropIfExists('categories');
    }
}
