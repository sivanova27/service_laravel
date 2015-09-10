<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('XRM_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->integer('residences_id')->unsigned();
			$table->string('nickname',45);
			$table->string('name',80);
			$table->string('email',100);
			$table->string('skype',25);
			$table->string('photo',45);
			$table->string('uniform_size',10);
			$table->integer('birth_date');
			$table->string('address',50);
			$table->char('working_days',7);
			$table->double('rate');
			$table->text('agreement');
			$table->tinyInteger('signed_agreement');
			$table->tinyInteger('debt');
			$table->tinyInteger('grade');
			$table->integer('for_royalty_date');
			$table->integer('start_date');
			$table->integer('end_date');
			$table->char('late_work',5);
			$table->char('start_from',5);
			$table->char('early_finish',5);
			$table->tinyInteger('bank_account');
			$table->tinyInteger('nin');
			$table->integer('li');
			$table->enum('smoker',['-1','0','1'])->default('0');
			$table->integer('positive_feedbacks');
			$table->integer('negative_feedbacks');
			$table->integer('complaints');
			$table->integer('cancellations');
			$table->integer('small_damages');
			$table->integer('big_damages');
			$table->double('compensation_sum');
			$table->integer('total_checks');
			$table->integer('experience');
			$table->float('average_grade');
			$table->double('rating');
			$table->float('stars');
			$table->tinyInteger('hide_in_royalty');
			$table->enum('status',['active','fired','correctly_quit','incorrectly_quit'])->default('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employees');
	}

}
