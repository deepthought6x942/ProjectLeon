<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionDonationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auction_donations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('id', true);
			$table->integer('uid');
			$table->string('title', 50);
			$table->date('year');
			$table->string('category', 100);
			$table->integer('quantity');
			$table->string('description', 1000);
			$table->string('status', 100);
			$table->string('location', 100);
			$table->decimal('approximate_value', 10, 0);
			$table->decimal('sold_for', 15, 0);
			$table->boolean('receipt_sent');
			$table->timestamps();
			$table->index(['uid','year'], 'uid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auction_donations');
	}

}
