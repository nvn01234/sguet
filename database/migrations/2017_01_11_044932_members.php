<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Members.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:48:18pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {

            $table->increments('id');

            $table->String('name');

            $table->date('birthday')->nullable();

            $table->String('class');

            $table->boolean('gender');

            $table->string('highest_position')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('specialize')->nullable();

            $table->unsignedInteger('team_id')->index()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
