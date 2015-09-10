<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employees_id')->unsigned();
			$table->integer('users_id')->unsigned();
			$table->integer('start')->unsigned();
			$table->integer('end')->unsigned();
			$table->text('comment');
			$table->tinyInteger('emergency');
			$table->enum('type',['day_off', 'annual_leave', 'sick']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dates');
	}

}
