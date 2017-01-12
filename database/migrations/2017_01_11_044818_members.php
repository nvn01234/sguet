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

            $table->String('avatar_url')->nullable();
        
            $table->String('class')->nullable();

            $table->date('joined_date')->nullable();

            /**
             * Foreignkeys section
             */
            $table->integer('user_id')->unsigned()->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');


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
        Schema::dropIfExists('members');
    }
}
