<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployeeQuality extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('employee_quality',function(Blueprint $table){
			$table->integer('qualities_id')->unsigned()->index();
			$table->integer('employee_id')->unsigned()->index();
			$table->string('value',70);
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
		Schema::drop('employee_quality');
		
	}

}
