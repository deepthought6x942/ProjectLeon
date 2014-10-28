<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first', 20);
			$table->string('last', 20);
			$table->string('email', 50)->index('email_2');
			$table->string('password', 60);
			$table->string('address1', 60)->nullable();
			$table->string('address2', 60)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 30)->nullable();
			$table->string('zip', 10)->nullable();
			$table->string('type', 30)->default('member');
			$table->string('telephone', 15)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
