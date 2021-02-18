<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameInquiriesTable extends Migration {

	public function up()
	{
		Schema::create('exame_inquiries', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exame_id')->unsigned();
			$table->integer('inquirie_id')->unsigned();
			$table->integer('student_id')->unsigned();
			$table->integer('value')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exame_inquiries');
	}
}