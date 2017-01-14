<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Positions.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:50:00pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Positions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {

            $table->increments('id');

            $table->String('name')->unique();

            $table->integer('priority')->unsigned()->default(0);

            /**
             * Foreignkeys section
             */


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
        Schema::dropIfExists('positions');
    }
}
