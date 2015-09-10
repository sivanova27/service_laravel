<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_rating', function(Blueprint $table)
		{
			$table->integer('date');
			$table->integer('employees_id');
			$table->float('average_grade');
			$table->integer('positive_feedbacks');
			$table->integer('negative_feedbacks');
			$table->integer('complaints');
			$table->integer('cancellations');
			$table->integer('small_damages');
			$table->integer('big_damages');
			$table->double('compensation_sum',10,2);
			$table->integer('total_checks');
			$table->integer('experience');
			$table->tinyInteger('for_royalty');
			$table->double('rating');
			$table->float('stars');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_rating');
	}

}
