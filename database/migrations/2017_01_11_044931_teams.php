<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

/**
 * Class Teams.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:49:32pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {

            $table->increments('id');

            $table->String('name')->unique();

            $table->integer('priority')->unsigned()->default(0);

            /**
             * Foreignkeys section
             */


            // type your addition here
            NestedSet::columns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
