<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentClassUsersTable extends Migration {

	public function up()
	{
		Schema::create('student_class_users', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('student_class_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('student_class_users');
	}
}