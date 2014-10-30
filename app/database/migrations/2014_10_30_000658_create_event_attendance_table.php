<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_attendance', function(Blueprint $table)
		{
			$table->integer('eid');
			$table->integer('uid');
			$table->string('role', 50);
			$table->timestamps();
			$table->index(['eid','uid'], 'EID');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_attendance');
	}

}
