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
			$table->string('email', 50)->unique('email');
			$table->string('password', 75);
			$table->string('address1', 75)->nullable();
			$table->string('address2', 60)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 30)->nullable();
			$table->string('zip', 10)->nullable();
			$table->string('type', 30)->default('member');
			$table->string('contact_preference', 75)->default('E-mail');
			$table->string('telephone', 15)->nullable();
			$table->timestamps();
			$table->string('remember_token', 100)->nullable();
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
