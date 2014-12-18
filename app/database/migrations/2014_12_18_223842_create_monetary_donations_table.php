<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonetaryDonationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monetary_donations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('id', true);
			$table->integer('uid')->index('uid_2');
			$table->string('check_number', 34)->unique('check_number');
			$table->integer('eid')->index('eid');
			$table->date('date');
			$table->decimal('amount', 10, 0);
			$table->string('notes', 500)->nullable();
			$table->boolean('receipt_sent')->default(0);
			$table->timestamps();
			$table->index(['uid','check_number','eid'], 'uid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monetary_donations');
	}

}
