<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMonetaryDonationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('monetary_donations', function(Blueprint $table)
		{
			$table->foreign('uid', 'monetary_donations_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('eid', 'monetary_donations_ibfk_2')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('monetary_donations', function(Blueprint $table)
		{
			$table->dropForeign('uid');
			$table->dropForeign('eid');
		});
	}

}
