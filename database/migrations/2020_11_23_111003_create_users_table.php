<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id', true);
			$table->string('username', 255);
			$table->string('email', 255);
			$table->string('password', 255);
			$table->string('avatar_url', 200)->nullable();
			$table->integer('user_role_id')->unsigned();
			$table->string('first_name', 255)->nullable();
			$table->string('last_name', 255)->nullable();
			$table->string('second_email', 255)->nullable();
			$table->string('linkedin_url', 255)->nullable();
			$table->integer('university_id')->unsigned()->nullable()->index();
			$table->text('resume')->nullable();
			$table->string('student_number', 100)->nullable();
			$table->tinyInteger('show_email')->default('0');
			$table->tinyInteger('show_performance')->default('0');
			$table->tinyInteger('active')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}