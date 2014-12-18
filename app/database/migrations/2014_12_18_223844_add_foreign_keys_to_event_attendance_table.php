<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_attendance', function(Blueprint $table)
		{
			$table->foreign('eid', 'event_attendance_ibfk_1')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('uid', 'event_attendance_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_attendance', function(Blueprint $table)
		{
			$table->dropForeign('event_attendance_ibfk_1');
			$table->dropForeign('event_attendance_ibfk_2');
		});
	}

}
