<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentClassesTable extends Migration {

	public function up()
	{
		Schema::create('student_classes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->integer('teacher_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('student_classes');
	}
}