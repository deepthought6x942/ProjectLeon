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
			$table->integer('eid')->index('eid_2');
			$table->integer('uid')->index('uid');
			$table->string('role', 50);
			$table->timestamps();
			$table->primary(['uid','eid']);
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
