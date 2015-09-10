<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployeeLanguage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('employee_language', function(Blueprint $table)
		{
			$table->char('language_id')->index();
			$table->integer('employee_id')->unsigned()->index();
			$table->enum('level',['excellent','very_good','good','average','bad','basic']);
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('employee_language');
	}

}
