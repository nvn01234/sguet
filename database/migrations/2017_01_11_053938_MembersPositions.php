<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersPositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('members_positions',function (Blueprint $table){
			$table->increments('id')->unique()->index()->unsigned();
			$table->integer('member_id')->unsigned()->index();
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
			$table->integer('position_id')->unsigned()->index();
			$table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
			/**
			 * Type your addition here
			 *
			 */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('members_positions');
    }
}
